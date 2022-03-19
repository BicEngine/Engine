<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Loop\Event;

use Bic\Loop\LoopInterface;

final class LoopTick extends LoopEvent
{
    /**
     * @var int|float
     * @psalm-readonly
     */
    public int|float $delta = 0;

    /**
     * @param LoopInterface $target
     * @param int|float|null $time
     * @param int|float $delta
     */
    public function __construct(
        LoopInterface $target,
        int|float|null $time = null,
        int|float $delta = 0,
    ) {
        parent::__construct($target, $time);

        $this->delta = $delta;
    }
}
