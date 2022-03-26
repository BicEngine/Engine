<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Dispatcher;

use Bic\Contracts\Dispatcher\DispatcherInterface;
use Bic\Contracts\Dispatcher\EventInterface;
use Bic\Contracts\Dispatcher\EventSubscriptionInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * @template T of EventInterface
 * @template-implements DispatcherInterface<T>
 * @see EventInterface
 */
final class Dispatcher implements DispatcherInterface
{
    /**
     * @param ListenerProviderInterface $provider
     * @param DispatcherInterface|null $parent
     */
    public function __construct(
        private readonly ListenerProviderInterface $provider,
        private readonly ?DispatcherInterface $parent = null
    ) {}

    /**
     * @param T $event
     * @return void
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function dispatch(object $event): void
    {
        /** @var EventSubscriptionInterface $subscription */
        foreach ($this->provider->getListenersForEvent($event) as $subscription) {
            $subscription->dispatch($event);
        }

        $this->parent?->dispatch($event);
    }
}
