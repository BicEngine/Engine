<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Container\Definition;

final class SingletonDefinition extends LazyDefinition
{
    /**
     * @var object|null
     */
    private ?object $instance = null;

    /**
     * {@inheritDoc}
     */
    public function resolve(callable|array $resolver = null): object
    {
        $this->resolving();

        try {
            return $this->instance ??= ($this->declarator)($resolver);
        } finally {
            $this->resolved();
        }
    }
}
