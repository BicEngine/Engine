<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Container\Definition;

use Bic\Contracts\Container\Definition\DefinitionInterface;

abstract class Definition implements DefinitionInterface
{
    /**
     * @param callable|array|null $resolver
     * @return object
     */
    abstract public function resolve(callable|array $resolver = null): object;
}
