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
 * @internal ImageType is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @link https://docs.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-loadimagew
 */
final class ImageType
{
    public const IMAGE_BITMAP        = 0x00;
    public const IMAGE_ICON          = 0x01;
    public const IMAGE_CURSOR        = 0x02;
}
