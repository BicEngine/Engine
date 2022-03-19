<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Loop;

use Bic\Dispatcher\ListenerInterface;
use Bic\Loop\Event\LoopEventInterface;

/**
 * @template-extends ListenerInterface<LoopEventInterface>
 * @see LoopEventInterface
 */
interface LoopInterface extends ListenerInterface
{
    /**
     * @return void
     */
    public function run(): void;

    /**
     * @return void
     */
    public function stop(): void;
}
