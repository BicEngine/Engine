<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot\Attribute;

use Psr\Container\ContainerInterface;

abstract class Execution extends MethodMetadata
{
    /**
     * @param array<class-string>|class-string $ifServiceExists
     */
    public function __construct(
        public readonly array|string $ifServiceExists = []
    ) {}

    /**
     * @param ContainerInterface $app
     * @return bool
     */
    public function isRunnable(ContainerInterface $app): bool
    {
        foreach ((array)$this->ifServiceExists as $service) {
            if (! $app->has($service)) {
                return false;
            }
        }

        return true;
    }
}
