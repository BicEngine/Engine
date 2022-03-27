<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Loop\Event;

use Bic\Contracts\Dispatcher\EventInterface;
use Bic\Loop\LoopInterface;

/**
 * @property-read LoopInterface $target
 * @template-extends EventInterface<LoopInterface>
 */
interface LoopEventInterface extends EventInterface
{
}
