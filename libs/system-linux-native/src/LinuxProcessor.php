<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Linux\Native;

use Bic\System\Linux\LinuxProcessorInterface;
use Bic\System\Processor;
use Bic\System\Processor\Architecture;
use Bic\System\Processor\FeatureInterface;

final class LinuxProcessor extends Processor implements LinuxProcessorInterface
{
    /**
     * @param Architecture $architecture
     * @param iterable<FeatureInterface> $features
     * @param int $core
     * @param float $rate
     * @param string $vendor
     * @param string $brand
     * @param int $family
     */
    public function __construct(
        Architecture $architecture,
        iterable $features,
        public readonly int $core,
        public readonly float $rate,
        public readonly string $vendor,
        public readonly string $brand,
        public readonly int $family,
    ) {
        parent::__construct($architecture, $features);
    }
}
