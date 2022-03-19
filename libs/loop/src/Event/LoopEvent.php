<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Loop\Event;

use Bic\Dispatcher\Event;
use Bic\Loop\LoopInterface;

/**
 * @property-read LoopInterface $target
 * @template-extends Event<LoopInterface>
 */
abstract class LoopEvent extends Event implements LoopEventInterface
{
    /**
     * @param LoopInterface $target
     * @param int|float|null $time
     */
    public function __construct(LoopInterface $target, int|float|null $time = null)
    {
        parent::__construct($target, $time);
    }
}
