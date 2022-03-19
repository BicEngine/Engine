<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot\Extension\Metadata;

use Bic\Boot\Attribute\ClassMetadata;
use Bic\Boot\Attribute\MethodMetadata;

abstract class MetadataProvider implements MetadataProviderInterface
{
    /**
     * @var array<ClassMetadata>
     */
    protected array $class = [];

    /**
     * @var array<array{\ReflectionMethod, MethodMetadata}>
     */
    protected array $methods = [];

    /**
     * {@inheritDoc}
     */
    public function getClassMetadata(string $attribute = null): iterable
    {
        foreach ($this->class as $attr) {
            if ($attribute === null || $attr instanceof $attribute) {
                yield $attr;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodMetadata(string $attribute = null): iterable
    {
        foreach ($this->methods as [$handler, $attr]) {
            if ($attribute === null || $attr instanceof $attribute) {
                yield $handler => $attr;
            }
        }
    }
}
