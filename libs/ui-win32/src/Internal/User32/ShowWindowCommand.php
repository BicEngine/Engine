<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Internal\User32;

/**
 * @internal ShowWindowCommand is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-showwindow
 */
final class ShowWindowCommand
{
    public const SW_HIDE             = 0;
    public const SW_SHOWNORMAL       = 1;
    public const SW_NORMAL           = 1;
    public const SW_SHOWMINIMIZED    = 2;
    public const SW_SHOWMAXIMIZED    = 3;
    public const SW_MAXIMIZE         = 3;
    public const SW_SHOWNOACTIVATE   = 4;
    public const SW_SHOW             = 5;
    public const SW_MINIMIZE         = 6;
    public const SW_SHOWMINNOACTIVE  = 7;
    public const SW_SHOWNA           = 8;
    public const SW_RESTORE          = 9;
    public const SW_SHOWDEFAULT      = 10;
    public const SW_FORCEMINIMIZE    = 11;
    public const SW_MAX              = 11;
}
