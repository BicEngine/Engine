<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Dispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * @template T of EventInterface
 */
interface DispatcherInterface extends EventDispatcherInterface
{
    /**
     * @param T $event
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function dispatch(object $event): void;
}
