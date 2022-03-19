<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native\Internal;

use FFI\CData;
use FFI\Proxy\Proxy;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @method CData GetDC(CData $hWnd)
 *
 * @method int DefWindowProcW(CData $hwnd, int $msg, int $wParam, int $lParam)
 * @method int DefWindowProcA(CData $hwnd, int $msg, int $wParam, int $lParam)
 *
 * @method int RegisterClassA(CData $lpWndClass)
 * @method int RegisterClassW(CData $lpWndClass)
 * @method int UnregisterClassA(CData|string $lpClassName, CData $hInstance)
 * @method int UnregisterClassW(CData|string $lpClassName, CData $hInstance)
 *
 * @method null|CData MonitorFromWindow(CData $hWnd, int $dwFlags)
 * @method int GetMonitorInfoA(CData $hMonitor, CData $lpmi)
 * @method int GetMonitorInfoW(CData $hMonitor, CData $lpmi)
 *
 * @method int SetWindowTextA(CData $hWnd, string|CData $lpString)
 * @method int SetWindowTextW(CData $hWnd, string|CData $lpString)
 *
 * @method CData|null LoadImageA(CData $hInst, string|CData $name, int $type, int $cx, int $cy, int $fuLoad)
 * @method CData|null LoadImageW(CData $hInst, string|CData $name, int $type, int $cx, int $cy, int $fuLoad)
 *
 * @method CData|null LoadIconA(CData $hInstance, string|CData $lpIconName)
 * @method CData|null LoadIconW(CData $hInstance, string|CData $lpIconName)
 * @method CData|null DrawIcon(CData $hdc, int $x, int $y, CData $hIcon)
 *
 * @method CData|null CreateWindowExA(int $dwExStyle, string|CData $lpClassName, string|CData $lpWindowName, int $dwStyle, int $x, int $y, int $width, int $height, ?CData $hWndParent, ?CData $hMenu, ?CData $hInstance, ?CData $lpParam)
 * @method CData|null CreateWindowExW(int $dwExStyle, string|CData $lpClassName, string|CData $lpWindowName, int $dwStyle, int $x, int $y, int $width, int $height, ?CData $hWndParent, ?CData $hMenu, ?CData $hInstance, ?CData $lpParam)
 *
 * @method int SetWindowPos(CData $hWnd, CData $hWndAfter, int $x, int $x, int $cx, int $cy, int $uFlags);
 * @method int ShowWindow(CData $hWnd, int $nCmdShow)
 *
 * @method int GetClientRect(CData $hWnd, CData $rect)
 * @method int GetWindowRect(CData $hWnd, CData $rect)
 * @method int GetWindowPlacement(CData $hWnd, CData $lpwndpl)
 *
 * @method int SetWindowLongA(CData $hWnd, int $nIndex, int $dwNewLong)
 * @method int SetWindowLongW(CData $hWnd, int $nIndex, int $dwNewLong)
 *
 * @method int DestroyWindow(CData $hWnd)
 * @method int DestroyIcon(CData $icon)
 *
 * @method int PeekMessageA(CData $msg, CData $hWnd, int $min, int $max, int $remove)
 * @method int PeekMessageW(CData $msg, CData $hWnd, int $min, int $max, int $remove)
 * @method int DispatchMessageA(CData $msg)
 * @method int DispatchMessageW(CData $msg)
 * @method int SendMessageA(CData $hWnd, int $msg, int $wParam, mixed $lParam)
 * @method int SendMessageW(CData $hWnd, int $msg, int $wParam, mixed $lParam)
 * @method int TranslateMessage(CData $msg)
 *
 * @method int GetKeyState(int $nVirtKey)
 *
 * @method int GetWindowTextLengthA(CData $hWnd)
 * @method int GetWindowTextLengthW(CData $hWnd)
 *
 * @method int GetWindowTextA(CData $hWnd, CData $lpString, int $nMaxCount)
 * @method int GetWindowTextW(CData $hWnd, CData $lpString, int $nMaxCount)
 */
class User32 extends Proxy
{
    /**
     * @var non-empty-string
     */
    private const DEFAULT_PATH_HEADERS = __DIR__ . '/../../resources/headers/user32.h';

    /**
     * @var non-empty-string
     */
    private const DEFAULT_PATH_BINARY = 'user32.dll';

    /**
     * @psalm-suppress MixedAssignment
     */
    public function __construct()
    {
        $this->ffi = \FFI::cdef(
            \file_get_contents(self::DEFAULT_PATH_HEADERS),
            self::DEFAULT_PATH_BINARY
        );
    }
}
