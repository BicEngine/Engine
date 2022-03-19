<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native;

use Bic\Dispatcher\DispatcherInterface;
use Bic\Dispatcher\EventSubscriptionInterface;
use Bic\Dispatcher\Exception\ListenerException;
use Bic\Loop\Event\LoopTick;
use Bic\Loop\LoopInterface;
use Bic\Ui\Exception\WindowException;
use Bic\Ui\Key\Event\KeyChar;
use Bic\Ui\Key\Event\KeyDown;
use Bic\Ui\Key\Event\KeyUp;
use Bic\Ui\Key\Key;
use Bic\Ui\Key\Mode;
use Bic\Ui\Mouse\Button;
use Bic\Ui\Mouse\Event\MouseDoubleClick;
use Bic\Ui\Mouse\Event\MouseDown;
use Bic\Ui\Mouse\Event\MouseEvent;
use Bic\Ui\Mouse\Event\MouseMove;
use Bic\Ui\Mouse\Event\MouseUp;
use Bic\Ui\Mouse\Event\MouseWheel;
use Bic\Ui\Mouse\Wheel\Direction;
use Bic\Ui\System\Encoding;
use Bic\Ui\Win32\Native\Internal\Unicode;
use Bic\Ui\Win32\Native\Internal\User32;
use Bic\Ui\Win32\Native\Internal\User32\IconSize;
use Bic\Ui\Win32\Native\Internal\User32\ImageType;
use Bic\Ui\Win32\Native\Internal\User32\ShowWindowCommand;
use Bic\Ui\Win32\Native\Internal\User32\VirtualKey;
use Bic\Ui\Win32\Native\Internal\User32\WindowClassStyle;
use Bic\Ui\Win32\Native\Internal\User32\WindowExtendedStyle;
use Bic\Ui\Win32\Native\Internal\User32\WindowMessage;
use Bic\Ui\Win32\Native\Internal\User32\WindowPosition;
use Bic\Ui\Win32\Native\Internal\User32\WindowStyle;
use Bic\Ui\Win32\Native\Internal\Word;
use Bic\Ui\Win32\Win32WindowInterface;
use Bic\Ui\Window\Event\WindowBlur;
use Bic\Ui\Window\Event\WindowClose;
use Bic\Ui\Window\Event\WindowEvent;
use Bic\Ui\Window\Event\WindowFocus;
use Bic\Ui\Window\Event\WindowMove;
use Bic\Ui\Window\Event\WindowRename;
use Bic\Ui\Window\Event\WindowResize;
use Bic\Ui\Window\Event\WindowShow;
use Bic\Ui\Window\Window as BaseWindow;
use Bic\Ui\Window\WindowCreateInfo;
use FFI\CData;
use FFI\Scalar\Type;

final class Win32Window extends BaseWindow implements Win32WindowInterface
{
    /**
     * @psalm-type WindowClassStyleFlag = WindowClassStyle::*
     * @var int-mask-of<WindowClassStyleFlag>
     */
    private const DEFAULT_CLASS_STYLE = WindowClassStyle::CS_HREDRAW
                                      | WindowClassStyle::CS_VREDRAW
                                      | WindowClassStyle::CS_OWNDC
                                      ;

    /**
     * @psalm-type WindowExtendedStyleFlag = WindowExtendedStyle::*
     * @var int-mask-of<WindowExtendedStyleFlag>
     */
    private const DEFAULT_EX_WINDOW_STYLE = WindowExtendedStyle::WS_EX_TOPMOST
                                          | WindowExtendedStyle::WS_EX_APPWINDOW
                                          ;

    /**
     * @psalm-type WindowStyleFlag = WindowStyle::*
     * @var int-mask-of<WindowStyleFlag>
     */
    private const DEFAULT_WINDOW_STYLE = WindowStyle::WS_SYSMENU
                                       | WindowStyle::WS_MINIMIZEBOX
                                       | WindowStyle::WS_CLIPSIBLINGS
                                       | WindowStyle::WS_CLIPCHILDREN
                                       ;

    /**
     * @var int
     */
    private const CW_USER_DEFAULT = 0x8000_0000;

    /**
     * @psalm-var CData
     * @var WNDCLASSW
     */
    private readonly CData $class;

    /**
     * @psalm-var CData
     * @var HWND
     */
    private readonly CData $hWnd;

    /**
     * @psalm-var CData
     * @var MSG
     */
    private readonly CData $msg;

    /**
     * @var EventSubscriptionInterface<MouseEvent|WindowEvent>
     */
    private readonly EventSubscriptionInterface $onTick;

    /**
     * @var bool
     */
    private bool $closed = false;

    /**
     * @var Encoding
     */
    private readonly Encoding $encoding;

    /**
     * @var Unicode
     */
    private readonly Unicode $unicode;

    /**
     * @param DispatcherInterface $dispatcher
     * @param LoopInterface $loop
     * @param User32 $user32
     * @param CData $hInstance
     * @param WindowCreateInfo $info
     * @throws WindowException
     * @throws ListenerException
     */
    public function __construct(
        DispatcherInterface $dispatcher,
        private readonly LoopInterface $loop,
        private readonly User32 $user32,
        private readonly CData $hInstance,
        private readonly WindowCreateInfo $info,
    ) {
        parent::__construct($dispatcher);

        $this->encoding = new Encoding('utf-16le', $info->encoding);
        $this->unicode = new Unicode();

        $this->class = $this->createClass();
        $this->hWnd = $this->createWindow($info->title);
        $this->msg = $this->user32->new('MSG', false);

        $this->onTick = $this->loop->listen(LoopTick::class, function () {
            $ptr = \FFI::addr($this->msg);

            if ($this->user32->PeekMessageW($ptr, $this->hWnd, 0, 0, 1)) {
                $this->user32->TranslateMessage($ptr);
                $this->user32->DispatchMessageW($ptr);
            }
        });

        $this->resize($info->width, $info->height);
        $this->move($info->left, $info->top);
    }

    /**
     * {@inheritDoc}
     */
    public function getHWnd(): CData
    {
        return $this->hWnd;
    }

    /**
     * @param string $text
     * @param bool $owned
     * @return LPCWSTR
     */
    protected function wideString(string $text, bool $owned = false): CData
    {
        return Type::wideString($this->encoding->encode($text), $owned);
    }

    /**
     * @psalm-return CData
     * @return WNDCLASSW
     * @psalm-suppress MixedArgument
     * @psalm-suppress ArgumentTypeCoercion
     * @psalm-suppress UndefinedDocblockClass
     * @throws WindowException
     */
    private function createClass(): CData
    {
        /** @var WNDCLASSW|CData|object $info */
        $info = $this->user32->new('WNDCLASSW');

        $info->style = self::DEFAULT_CLASS_STYLE;
        $info->hInstance = $this->hInstance;
        $info->lpszClassName = $this->wideString($this->id);
        $info->lpfnWndProc = $this->onWinProc(...);

        if (! $this->user32->RegisterClassW(\FFI::addr($info))) {
            throw new WindowException(\sprintf('Failed to register window class "%s"', $this->id));
        }

        return $info;
    }

    /**
     * @param string $title
     * @psalm-return CData
     * @return HWND
     * @throws WindowException
     */
    private function createWindow(string $title): CData
    {
        $style = self::DEFAULT_WINDOW_STYLE;

        if ($this->info->resizable) {
            $style |= WindowStyle::WS_SIZEBOX;
        }

        $window = $this->user32->CreateWindowExW(
            /* DWORD     dwExStyle    */ self::DEFAULT_EX_WINDOW_STYLE,
            /* LPCSTR    lpClassName  */ $this->wideString($this->id),
            /* LPCSTR    lpWindowName */ $this->wideString($title),
            /* DWORD     dwStyle      */ $style,
            /* int       X            */ self::CW_USER_DEFAULT,
            /* int       Y            */ self::CW_USER_DEFAULT,
            /* int       nWidth       */ self::CW_USER_DEFAULT,
            /* int       nHeight      */ self::CW_USER_DEFAULT,
            /* HWND      hWndParent   */ null,
            /* HMENU     hMenu        */ null,
            /* HINSTANCE hInstance    */ $this->hInstance,
            /* LPVOID    lpPara       */ null
        );

        if ($window === null) {
            throw new WindowException(\sprintf('Failed to create window "%s"', $this->id));
        }

        return $window;
    }

    /**
     * @param Mode $mode
     * @return bool
     */
    private function getKeyState(Mode $mode): bool
    {
        return match ($mode) {
            Mode::SHIFT => (bool)($this->user32->GetKeyState(VirtualKey::VK_SHIFT) & 0x8000),
            Mode::CONTROL => (bool)($this->user32->GetKeyState(VirtualKey::VK_CONTROL) & 0x8000),
            Mode::ALT => (bool)($this->user32->GetKeyState(VirtualKey::VK_MENU) & 0x8000),
            Mode::SUPER => (bool)(
                (
                    $this->user32->GetKeyState(VirtualKey::VK_LWIN) |
                    $this->user32->GetKeyState(VirtualKey::VK_RWIN)
                ) & 0x8000
            ),
            Mode::CAPS_LOCK => (bool)($this->user32->GetKeyState(VirtualKey::VK_CAPITAL) & 1),
            Mode::NUM_LOCK => (bool)($this->user32->GetKeyState(VirtualKey::VK_NUMLOCK) & 1),
        };
    }

    /**
     * @psalm-type WindowMessageFlag = WindowMessage::WM_*
     *
     * @param CData $hWnd
     * @param WindowMessageFlag $uMsg
     * @param positive-int|0 $wParam
     * @param positive-int|0 $lParam
     * @return int
     */
    private function onWinProc(CData $hWnd, int $uMsg, int $wParam, int $lParam): int
    {
        switch ($uMsg) {
            /**
             * -----------------------------------------------------------------
             *  Window Events
             * -----------------------------------------------------------------
             */
            case WindowMessage::WM_CLOSE:
                $this->close();
                break;

            case WindowMessage::WM_SETFOCUS:
                $this->dispatcher->dispatch(new WindowFocus($this));
                break;

            case WindowMessage::WM_SHOWWINDOW:
                $this->dispatcher->dispatch(new WindowShow($this));
                break;

            case WindowMessage::WM_KILLFOCUS:
                $this->dispatcher->dispatch(new WindowBlur($this));
                break;

            case WindowMessage::WM_SIZE:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new WindowResize($this, $x, $y));
                break;

            case WindowMessage::WM_MOVE:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new WindowMove($this, $x, $y));
                break;

            case WindowMessage::WM_SETTEXT:
                $this->dispatcher->dispatch(new WindowRename($this, $this->getName()));
                break;

            /**
             * -----------------------------------------------------------------
             *  Mouse Events
             * -----------------------------------------------------------------
             */
            case WindowMessage::WM_MOUSEMOVE:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseMove($this, $x, $y));
                break;

            case WindowMessage::WM_MOUSEWHEEL:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $direction = Word::high($wParam) < 0 ? Direction::DOWN : Direction::UP;
                $this->dispatcher->dispatch(new MouseWheel($this, $direction, $x, $y));
                break;

            case WindowMessage::WM_MOUSEHWHEEL:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $direction = Word::high($wParam) < 0 ? Direction::LEFT : Direction::RIGHT;
                $this->dispatcher->dispatch(new MouseWheel($this, $direction, $x, $y));
                break;

            case WindowMessage::WM_LBUTTONDOWN:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseDown($this, Button::LEFT, $x, $y));
                break;

            case WindowMessage::WM_LBUTTONUP:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseUp($this, Button::LEFT, $x, $y));
                break;

            case WindowMessage::WM_LBUTTONDBLCLK:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseDoubleClick($this, Button::LEFT, $x, $y));
                break;

            case WindowMessage::WM_RBUTTONDOWN:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseDown($this, Button::RIGHT, $x, $y));
                break;

            case WindowMessage::WM_RBUTTONUP:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseUp($this, Button::RIGHT, $x, $y));
                break;

            case WindowMessage::WM_RBUTTONDBLCLK:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseDoubleClick($this, Button::RIGHT, $x, $y));
                break;

            case WindowMessage::WM_MBUTTONDOWN:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseDown($this, Button::MIDDLE, $x, $y));
                break;

            case WindowMessage::WM_MBUTTONUP:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseUp($this, Button::MIDDLE, $x, $y));
                break;

            case WindowMessage::WM_MBUTTONDBLCLK:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $this->dispatcher->dispatch(new MouseDoubleClick($this, Button::MIDDLE, $x, $y));
                break;

            case WindowMessage::WM_XBUTTONDOWN:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $button = Button::create(Button::LAST + Word::high($wParam));
                $this->dispatcher->dispatch(new MouseDown($this, $button, $x, $y));
                break;

            case WindowMessage::WM_XBUTTONUP:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $button = Button::create(Button::LAST + Word::high($wParam));
                $this->dispatcher->dispatch(new MouseUp($this, $button, $x, $y));
                break;

            case WindowMessage::WM_XBUTTONDBLCLK:
                $x = Word::low($lParam);
                $y = Word::high($lParam);
                $button = Button::create(Button::LAST + Word::high($wParam));
                $this->dispatcher->dispatch(new MouseDoubleClick($this, $button, $x, $y));
                break;

            /**
             * -----------------------------------------------------------------
             *  Keyboard Events
             * -----------------------------------------------------------------
             */
            case WindowMessage::WM_KEYDOWN:
            case WindowMessage::WM_SYSKEYDOWN:
                $this->dispatcher->dispatch(new KeyDown(
                    target: $this,
                    key: Key::create(Word::low($wParam)),
                    keyState: $this->getKeyState(...),
                ));
                break;

            case WindowMessage::WM_KEYUP:
            case WindowMessage::WM_SYSKEYUP:
                $this->dispatcher->dispatch(new KeyUp(
                    target: $this,
                    key: Key::create(Word::low($wParam)),
                    keyState: $this->getKeyState(...),
                ));
                break;

            case WindowMessage::WM_UNICHAR:
            case WindowMessage::WM_CHAR:
                if (($char = $this->unicode->nextChar($wParam)) !== null) {
                    $this->dispatcher->dispatch(new KeyChar(
                        target: $this,
                        char: $char,
                        key: Key::create(Word::low($wParam)),
                        keyState: $this->getKeyState(...),
                    ));
                }

                break;
        }

        return $this->user32->DefWindowProcW($hWnd, $uMsg, $wParam, $lParam);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        // Poll window name length with trailing \0
        $length = $this->user32->GetWindowTextLengthW($this->hWnd) + 1;

        // Allocate memory and poll window name
        $name = \FFI::new('char[' . ($length * 2) . ']');
        $this->user32->GetWindowTextW($this->hWnd, $name, $length);

        // Concat all chars to binary string
        $result = '';
        foreach ($name as $char) {
            $result .= $char;
        }

        return $this->encoding->decode($result);
    }

    /**
     * {@inheritDoc}
     */
    public function rename(string $name = null): void
    {
        try {
            $text = $this->wideString($name ?? $this->info->title);

            $this->user32->SetWindowTextW($this->hWnd, $text);
        } finally {
            \FFI::free(\FFI::addr($text));
        }
    }


    /**
     * @param string $pathname
     * @param int $winSize
     * @param int $taskbarSize
     * @return void
     * @throws WindowException
     */
    public function setIcon(string $pathname, int $winSize = 32, int $taskbarSize = 256): void
    {
        $window = $this->loadImage($pathname, $winSize);
        $param = $this->user32->cast('LPARAM', $window);
        $this->user32->SendMessageW($this->hWnd, WindowMessage::WM_SETICON, IconSize::ICON_SMALL, \FFI::addr($param));

        $taskbar = $this->loadImage($pathname, $taskbarSize);
        $param = $this->user32->cast('LPARAM', $taskbar);
        $this->user32->SendMessageW($this->hWnd, WindowMessage::WM_SETICON, IconSize::ICON_BIG, \FFI::addr($param));
    }

    /**
     * @param string $pathname
     * @param int $size
     * @return CData
     * @throws WindowException
     */
    private function loadImage(string $pathname, int $size): CData
    {
        $region = User32\ImageLoadRegion::LR_LOADFROMFILE;

        if (!\is_readable($pathname)) {
            throw new WindowException('Image file not readable: ' . $pathname);
        }

        try {
            $path = $this->wideString($pathname);

            $image = $this->user32->LoadImageW($this->hInstance, $path, ImageType::IMAGE_ICON, $size, $size, $region);

            if ($image === null) {
                throw new WindowException('Could not load image: ' . $pathname);
            }

            return $image;
        } finally {
            \FFI::free(\FFI::addr($path));
        }
    }

    /**
     * {@inheritDoc}
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getSize(): array
    {
        assert($this->closed === false, 'Window already has been closed');
        /** @var RECT $rect */
        $rect = $this->user32->new('RECT');

        $this->user32->GetClientRect($this->hWnd, \FFI::addr($rect));

        return [$rect->right, $rect->bottom];
    }

    /**
     * {@inheritDoc}
     */
    public function resize(int $width = null, int $height = null): void
    {
        assert($this->closed === false, 'Window already has been closed');
        assert($width > 0 || $width === null, 'Window width MUST be greater than 0');
        assert($height > 0 || $height === null, 'Window height MUST be greater than 0');

        [$cw, $ch] = $this->getSize();

        $width ??= $cw;
        $height ??= $ch;

        $this->user32->SetWindowPos($this->hWnd, null, 0, 0, $width, $height, WindowPosition::SWP_NOMOVE);
    }

    /**
     * {@inheritDoc}
     */
    public function show(): void
    {
        assert($this->closed === false, 'Window already has been closed');

        $this->user32->ShowWindow($this->hWnd, ShowWindowCommand::SW_SHOW);
    }

    /**
     * {@inheritDoc}
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getPosition(): array
    {
        assert($this->closed === false, 'Window already has been closed');

        /** @var RECT $rect */
        $rect = $this->user32->new('RECT');

        $this->user32->GetWindowRect($this->hWnd, \FFI::addr($rect));

        return [$rect->left, $rect->top];
    }

    /**
     * {@inheritDoc}
     */
    public function move(int $x = null, int $y = null): void
    {
        assert($this->closed === false, 'Window already has been closed');

        [$cx, $cy] = $this->getPosition();

        $x ??= $cx;
        $y ??= $cy;

        $this->user32->SetWindowPos($this->hWnd, null, $x, $y, 0, 0, WindowPosition::SWP_NOSIZE);
    }

    /**
     * {@inheritDoc}
     */
    public function hide(): void
    {
        assert($this->closed === false, 'Window already has been closed');

        $this->user32->ShowWindow($this->hWnd, ShowWindowCommand::SW_HIDE);
    }

    /**
     * @return void
     */
    public function close(): void
    {
        if ($this->closed === false) {
            $this->dispatcher->dispatch(new WindowClose($this));

            $this->onTick->cancel();
            $this->listener->cancelAll();

            $this->user32->DestroyWindow($this->hWnd);
            $this->user32->UnregisterClassW($this->wideString($this->id, true), $this->hInstance);

            \FFI::free(\FFI::addr($this->msg));

            $this->closed = true;
        }
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->close();
    }
}
