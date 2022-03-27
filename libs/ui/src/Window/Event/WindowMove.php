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

final class WindowMove extends WindowEvent
{
    /**
     * @param WindowInterface $target
     * @param int $x
     * @param int $y
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public int $x,
        public int $y,
        int|float|null $time = null
    ) {
        parent::__construct($target, $time);
    }
}
