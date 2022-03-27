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
 * @internal ImageLoadRegion is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-loadimagew
 */
final class ImageLoadRegion
{
    public const LR_DEFAULTCOLOR     = 0x0000_0000;
    public const LR_MONOCHROME       = 0x0000_0001;
    public const LR_COLOR            = 0x0000_0002;
    public const LR_COPYRETURNORG    = 0x0000_0004;
    public const LR_COPYDELETEORG    = 0x0000_0008;
    public const LR_LOADFROMFILE     = 0x0000_0010;
    public const LR_LOADTRANSPARENT  = 0x0000_0020;
    public const LR_DEFAULTSIZE      = 0x0000_0040;
    public const LR_VGACOLOR         = 0x0000_0080;
    public const LR_LOADMAP3DCOLORS  = 0x0000_1000;
    public const LR_CREATEDIBSECTION = 0x0000_2000;
    public const LR_COPYFROMRESOURCE = 0x0000_4000;
    public const LR_SHARED           = 0x0000_8000;
}
