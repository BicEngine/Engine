<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native\Internal;

final class Unicode
{
    /**
     * @var int
     */
    private int $highSurrogate = 0;

    /**
     * @param int $code
     * @return string|null
     */
    public function nextChar(int $code): ?string
    {
        /**
         * When a user enters a Unicode code point defined in the
         * Basic Multilingual Plane, Windows sends a WM_CHAR message
         * with the code point encoded as UTF-16. When a user enters a
         * Unicode code point from a Supplementary Plane, Windows sends
         * the code point in two separate WM_CHAR messages: The first
         * message includes the UTF-16 High Surrogate and the second the
         * UTF-16 Low Surrogate. The High and Low Surrogates cannot be
         * individually converted to valid UTF-8, therefore, we must
         * save the High Surrogate from the first WM_CHAR message and
         * concatenate it with the Low Surrogate from the second WM_CHAR
         * message. At that point, we have a valid UTF-16 surrogate pair
         * ready to re-encode as UTF-8.
         */
        if (Unicode::isHighSurrogate($code)) {
            $this->highSurrogate = $code;

            return null;
        }

        $codepoint = $code;

        if (Unicode::isSurrogatePair($this->highSurrogate, $code)) {
            $codepoint += ($this->highSurrogate - 0xD800) << 10;
            $codepoint += $code - 0xDC00;
            $codepoint += 0x10000;
        }

        $this->highSurrogate = 0;

        return \mb_chr($codepoint);
    }

    /**
     * @param int $char
     * @return bool
     */
    public static function isHighSurrogate(int $char): bool
    {
        return $char >= 0xD800 && $char <= 0xDBFF;
    }

    /**
     * @param int $char
     * @return bool
     */
    public static function isLowSurrogate(int $char): bool
    {
        return $char >= 0xDC00 && $char <= 0xDFFF;
    }

    /**
     * @param int $char
     * @return bool
     */
    public static function isSurrogate(int $char): bool
    {
        return self::isLowSurrogate($char) || self::isHighSurrogate($char);
    }

    /**
     * @param int $low
     * @param int $high
     * @return bool
     */
    public static function isSurrogatePair(int $low, int $high): bool
    {
        return self::isHighSurrogate($high) && self::isLowSurrogate($low);
    }
}
