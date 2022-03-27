<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Loop;

use Bic\Dispatcher\Dispatcher;
use Bic\Contracts\Dispatcher\DispatcherInterface;
use Bic\Contracts\Dispatcher\EventSubscriptionInterface;
use Bic\Dispatcher\Listener;
use Bic\Contracts\Dispatcher\ListenerInterface;
use Bic\Loop\Event\LoopEventInterface;
use Bic\Loop\Event\LoopStart;
use Bic\Loop\Event\LoopStop;
use Bic\Loop\Event\LoopTick;
use Psr\EventDispatcher\ListenerProviderInterface;

class Loop implements LoopInterface
{
    /**
     * @var bool
     */
    protected bool $running = false;

    /**
     * @var DispatcherInterface<LoopEventInterface>
     */
    private readonly DispatcherInterface $dispatcher;

    /**
     * @psalm-suppress PropertyTypeCoercion
     * @param ListenerInterface<LoopEventInterface>&ListenerProviderInterface $listener
     */
    public function __construct(
        private readonly ListenerInterface&ListenerProviderInterface $listener = new Listener()
    ) {
        $this->dispatcher = new Dispatcher($this->listener);
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
    public function run(): void
    {
        if ($this->running) {
            return;
        }

        $this->dispatcher->dispatch(new LoopStart($this));
        $this->running = true;

        $tick = new LoopTick($this);

        while ($this->running) {
            $previous = $tick->time;
            /** @psalm-suppress InaccessibleProperty */
            $tick->time = \microtime(true);
            $tick->delta = $tick->time - $previous;

            $this->dispatcher->dispatch($tick);

            \usleep(1);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function stop(): void
    {
        $this->dispatcher->dispatch(new LoopStop($this));
        $this->running = false;
    }
}
