<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Win32\Native;

use Bic\System\Processor;
use Bic\System\Processor\Architecture;
use Bic\System\Processor\FeatureInterface;
use Bic\System\Win32\Win32ProcessorInterface;

final class Win32Processor extends Processor implements Win32ProcessorInterface
{
    /**
     * @param Architecture $architecture
     * @param iterable<FeatureInterface> $features
     */
    public function __construct(
        Architecture $architecture,
        iterable $features,
    ) {
        parent::__construct($architecture, $features);
    }

    /**
     * {@inheritDoc}
     */
    public function getArchitecture(): Architecture
    {
        return $this->architecture;
    }
}
