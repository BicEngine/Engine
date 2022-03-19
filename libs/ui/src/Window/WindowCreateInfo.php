<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window;

final class WindowCreateInfo
{
    /**
     * @param string $title Window title
     * @param positive-int $width Window width in pixels
     * @param positive-int $height Window height in pixels
     * @param positive-int|0 $left Window left position in pixels
     * @param positive-int|0 $top Window top position in pixels
     * @param bool $resizable Allow window resize
     * @param string $encoding Application-aware encoding
     */
    public function __construct(
        public string $title = 'Bic Engine',
        public int $width = WindowInterface::DEFAULT_WIDTH,
        public int $height = WindowInterface::DEFAULT_HEIGHT,
        public int $left = 0,
        public int $top = 0,
        public bool $resizable = false,
        public string $encoding = 'utf-8',
    ) {}
}
