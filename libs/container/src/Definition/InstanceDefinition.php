<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Container\Definition;

final class InstanceDefinition extends Definition
{
    /**
     * @var object
     */
    private object $instance;

    /**
     * @param object $instance
     */
    public function __construct(object $instance)
    {
        $this->instance = $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(callable|array $resolver = null): object
    {
        return $this->instance;
    }
}
