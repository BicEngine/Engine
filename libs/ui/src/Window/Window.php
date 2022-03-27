<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window;

use Bic\Dispatcher\Dispatcher;
use Bic\Contracts\Dispatcher\DispatcherInterface;
use Bic\Contracts\Dispatcher\EventSubscriptionInterface;
use Bic\Dispatcher\Listener;
use Ramsey\Uuid\Uuid;

abstract class Window implements WindowInterface
{
    /**
     * @var non-empty-string
     */
    public readonly string $id;

    /**
     * @var Listener<WindowEventInterface>
     */
    protected readonly Listener $listener;

    /**
     * @var DispatcherInterface<WindowEventInterface>
     */
    protected readonly DispatcherInterface $dispatcher;

    /**
     * @psalm-suppress PropertyTypeCoercion
     * @psalm-suppress MixedArgumentTypeCoercion
     */
    public function __construct(DispatcherInterface $dispatcher)
    {
        $this->id = (string)Uuid::uuid4();
        $this->listener = new Listener();
        $this->dispatcher = new Dispatcher($this->listener, $dispatcher);
    }

    /**
     * {@inheritDoc}
     */
    public function listen(callable|string $handlerOrEventClass, ?callable $handler = null): EventSubscriptionInterface
    {
        return $this->listener->listen($handlerOrEventClass, $handler);
    }

    /**
     * {@inheritDoc}
     */
    public function cancel(EventSubscriptionInterface|\Stringable|string $subscription): void
    {
        $this->listener->cancel($subscription);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): string
    {
        return $this->id;
    }
}
