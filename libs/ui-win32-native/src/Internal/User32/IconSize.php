<?php

/**
 * This file is part of Ui package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native\Internal\User32;

/**
 * @internal IconSize is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/winmsg/wm-seticon
 */
final class IconSize
{
    public const ICON_SMALL          = 0x00;
    public const ICON_BIG            = 0x01;
    public const ICON_SMALL2         = 0x02;
}
