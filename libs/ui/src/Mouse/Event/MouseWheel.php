<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Mouse\Event;

use Bic\Contracts\Ui\Window\WindowInterface;
use Bic\Ui\Mouse\Wheel\Direction;

final class MouseWheel extends MouseEvent
{
    /**
     * @param WindowInterface $target
     * @param Direction $direction
     * @param int $x
     * @param int $y
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public Direction $direction,
        int $x = 0,
        int $y = 0,
        int|float|null $time = null
    ) {
        parent::__construct($target, $x, $y, $time);
    }
}
