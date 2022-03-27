<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32;

use Bic\Contracts\Dispatcher\ListenerInterface;
use Bic\Contracts\Ui\Win32\Win32WindowManagerInterface;
use Bic\Dispatcher\Exception\ListenerException;
use Bic\Dispatcher\Listener;
use Bic\Loop\LoopInterface;
use Bic\Ui\Win32\Internal\Kernel32;
use Bic\Ui\Win32\Internal\User32;
use Bic\Ui\Window\Event\WindowClose;
use Bic\Ui\Window\WindowCreateInfo;
use Bic\Ui\Window\WindowEventInterface;
use Bic\Ui\Window\WindowManager as BaseWindowManager;
use FFI\CData;
use FFI\Env\Runtime;
use Psr\EventDispatcher\ListenerProviderInterface;

final class Win32WindowManager extends BaseWindowManager implements Win32WindowManagerInterface
{
    /**
     * @link https://docs.microsoft.com/en-us/windows/win32/winmsg/using-window-classes
     *
     * @psalm-var CData
     * @var HINSTANCE
     */
    public readonly CData $hInstance;

    /**
     * @var User32
     */
    public readonly User32 $user32;

    /**
     * @var Kernel32
     */
    public readonly Kernel32 $kernel32;

    /**
     * @param LoopInterface $loop
     * @param ListenerInterface<WindowEventInterface>&ListenerProviderInterface $listener
     * @throws ListenerException
     */
    public function __construct(
        LoopInterface $loop,
        ListenerInterface&ListenerProviderInterface $listener = new Listener(),
    ) {
        parent::__construct($loop, $listener);

        Runtime::assertAvailable();

        $this->user32 = new User32();
        $this->kernel32 = new Kernel32();
        $this->hInstance = $this->kernel32->GetModuleHandleW(null);

        $this->listen(function (WindowClose $e): void {
            $this->windows->detach($e->target);
        });
    }

    /**
     * {@inheritDoc}
     * @psalm-suppress RedundantCondition
     */
    public function create(WindowCreateInfo $info = new WindowCreateInfo()): Win32Window
    {
        $window = new Win32Window($this->dispatcher, $this->loop, $this->user32, $this->hInstance, $info);

        $this->windows->attach($window);

        return $window;
    }
}
