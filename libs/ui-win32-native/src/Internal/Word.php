<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native\Internal;

final class Word
{
    /**
     * @param positive-int|0 $value
     * @return int
     */
    public static function low(int $value): int
    {
        return self::ushort($value & 0xffff);
    }

    /**
     * <code>
     *  (unsigned short)((unsigned long)value >> 16) & 0xffff
     * </code>
     *
     * @param positive-int|0 $value
     * @return int
     */
    public static function high(int $value): int
    {
        return self::ushort(($value >> 16) & 0xFFFF);
    }

    /**
     * (unsigned short)(int64)
     *
     * @param int $value
     * @return int
     */
    private static function ushort(int $value): int
    {
        return $value > 32_767 ? $value - 65_536 : $value;
    }
}
