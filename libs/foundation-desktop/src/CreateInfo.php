<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Desktop;

use Bic\Boot\ExtensionInterface;
use Bic\Foundation\Path;
use Psr\Container\ContainerInterface;
use Bic\Foundation\CreateInfo as BaseCreateInfo;

class CreateInfo extends BaseCreateInfo
{
    /**
     * @param bool|null $debug
     * @param Path|non-empty-string $path
     * @param array<ExtensionInterface|class-string<ExtensionInterface>> $extensions
     * @param ContainerInterface|null $container
     */
    public function __construct(
        ?bool $debug = null,
        Path|string $path = new Path(),
        array $extensions = [],
        ContainerInterface $container = null,
    ) {
        parent::__construct($debug, $path, $extensions, $container);
    }

    /**
     * @param Path|non-empty-string $path
     * @return Path
     */
    protected function bootPathValue(Path|string $path): Path
    {
        return $path instanceof Path ? $path : new Path(root: $path);
    }
}
