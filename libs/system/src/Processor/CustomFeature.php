<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Processor;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\System
 */
final class CustomFeature implements FeatureInterface
{
    /**
     * @param non-empty-string $name
     * @internal Please use {@see Feature::create()} method instead.
     */
    public function __construct(
        public readonly string $name,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
