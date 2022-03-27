<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window;

use Bic\Contracts\Dispatcher\DispatcherInterface;
use Bic\Contracts\Dispatcher\EventSubscriptionInterface;
use Bic\Contracts\Dispatcher\ListenerInterface;
use Bic\Contracts\Ui\Window\WindowManagerInterface;
use Bic\Dispatcher\Dispatcher;
use Bic\Dispatcher\Listener;
use Bic\Loop\LoopInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * @template-implements \IteratorAggregate<array-key, WindowInterface>
 */
abstract class WindowManager implements WindowManagerInterface, \IteratorAggregate
{
    /**
     * @var \SplObjectStorage<WindowInterface, array>
     */
    protected readonly \SplObjectStorage $windows;

    /**
     * @var DispatcherInterface
     */
    protected readonly DispatcherInterface $dispatcher;

    /**
     * @param LoopInterface $loop
     * @param ListenerInterface<WindowEventInterface>&ListenerProviderInterface $listener
     */
    public function __construct(
        protected readonly LoopInterface $loop,
        protected readonly ListenerInterface&ListenerProviderInterface $listener = new Listener(),
    ) {
        $this->windows = new \SplObjectStorage();
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
    public function getIterator(): \Traversable
    {
        return $this->windows;
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return $this->windows->count();
    }
}
