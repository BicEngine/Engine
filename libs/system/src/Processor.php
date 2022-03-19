<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System;

use Bic\Collection\SetInterface;
use Bic\System\Processor\Architecture;
use Bic\System\Processor\FeatureInterface;
use Bic\System\Processor\FeatureSet;

abstract class Processor implements ProcessorInterface
{
    /**
     * @var SetInterface<FeatureInterface>
     */
    public readonly SetInterface $features;

    /**
     * @param Architecture $architecture
     * @param iterable<FeatureInterface> $features
     */
    public function __construct(
        public readonly Architecture $architecture,
        iterable $features,
    ) {
        $this->features = FeatureSet::new($features);
    }

    /**
     * {@inheritDoc}
     */
    public function getArchitecture(): Architecture
    {
        return $this->architecture;
    }

    /**
     * {@inheritDoc}
     */
    public function getFeatures(): SetInterface
    {
        return $this->features;
    }

    /**
     * {@inheritDoc}
     */
    public function supports(FeatureInterface $feature): bool
    {
        return $this->features->contains($feature);
    }
}
