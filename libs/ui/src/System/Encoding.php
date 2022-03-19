<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\System;

/**
 * @psalm-suppress TypeDoesNotContainType
 * @psalm-suppress LessSpecificReturnStatement
 * @psalm-suppress MoreSpecificReturnType
 */
final class Encoding
{
    /**
     * @param non-empty-string $os
     * @param non-empty-string $php
     */
    public function __construct(
        private string $os = 'utf-8',
        private string $php = 'utf-8',
    ) {
        $this->os = \strtolower($this->os);
        $this->php = \strtolower($this->php);
    }

    /**
     * @param non-empty-string $text
     * @return non-empty-string
     */
    public function encode(string $text): string
    {
        if ($this->os === $this->php || $text === '') {
            return $text;
        }

        return \iconv($this->php, $this->os, $text);
    }

    /**
     * @param non-empty-string $text
     * @return non-empty-string
     */
    public function decode(string $text): string
    {
        if ($this->os === $this->php || $text === '') {
            return $text;
        }

        return \iconv($this->os, $this->php, \rtrim($text, "\0"));
    }
}
