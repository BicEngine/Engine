<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot;

use Bic\Boot\Extension\Info\InfoProviderInterface;
use Bic\Boot\Attribute\ClassMetadata;
use Bic\Boot\Attribute\MethodMetadata;
use Bic\Boot\Extension\Metadata\MetadataProviderInterface;

/**
 * @see MethodMetadata
 * @see ClassMetadata
 */
interface ExtensionInterface extends
    MetadataProviderInterface,
    InfoProviderInterface
{
    /**
     * @return object
     */
    public function getContext(): object;
}
