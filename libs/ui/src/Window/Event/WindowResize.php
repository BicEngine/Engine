<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window\Event;

use Bic\Contracts\Ui\Window\WindowInterface;

final class WindowResize extends WindowEvent
{
    /**
     * @param WindowInterface $target
     * @param positive-int $width
     * @param positive-int $height
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public int $width,
        public int $height,
        int|float|null $time = null
    ) {
        parent::__construct($target, $time);
    }
}
