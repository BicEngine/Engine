<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class Info extends ClassMetadata
{
    /**
     * @param string|null $name
     * @param string|null $description
     * @param string|null $version
     */
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $version = null,
    ) {}
}
