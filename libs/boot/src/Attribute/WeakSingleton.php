<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot\Attribute;

use Bic\Container\Container;
use Bic\Container\Definition\WeakSingletonDefinition;
use Bic\Contracts\Container\Definition\DefinitionInterface;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class WeakSingleton extends ServiceDefinition
{
    /**
     * {@inheritDoc}
     */
    public function create(string $id, Container $container, callable $declarator): DefinitionInterface
    {
        return new WeakSingletonDefinition($id, $container, $declarator);
    }
}
