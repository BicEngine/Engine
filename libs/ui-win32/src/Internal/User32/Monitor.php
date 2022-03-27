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
 * @internal Monitor is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 */
final class Monitor
{
    public const MONITOR_DEFAULTTONULL       = 0x0000_0000;
    public const MONITOR_DEFAULTTOPRIMARY    = 0x0000_0001;
    public const MONITOR_DEFAULTTONEAREST    = 0x0000_0002;
}
