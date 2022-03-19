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

interface ProcessorInterface
{
    /**
     * @return Architecture
     */
    public function getArchitecture(): Architecture;

    /**
     * @return SetInterface<FeatureInterface>
     */
    public function getFeatures(): SetInterface;

    /**
     * @param FeatureInterface $feature
     * @return bool
     */
    public function supports(FeatureInterface $feature): bool;
}
