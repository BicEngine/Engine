<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Container\Definition;

use Bic\Container\Container;

final class WeakSingletonDefinition extends LazyDefinition
{
    /**
     * @var \WeakReference
     */
    private \WeakReference $instance;

    /**
     * {@inheritDoc}
     */
    public function __construct(string $id, Container $container, callable $declarator)
    {
        $this->instance = \WeakReference::create(new \stdClass());

        parent::__construct($id, $container, $declarator);
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(callable|array $resolver = null): object
    {
        $this->resolving();

        try {
            if ($instance = $this->instance->get()) {
                return $instance;
            }

            $this->instance = \WeakReference::create(
                $instance = ($this->declarator)($resolver)
            );

            return $instance;
        } finally {
            $this->resolved();
        }
    }
}
