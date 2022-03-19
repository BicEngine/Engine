<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Desktop;

use Bic\Foundation\Path as BasePath;

/**
 * @psalm-import-type PathDelimiterType from BasePath
 */
class Path extends BasePath
{
    /**
     * @var non-empty-string
     */
    public readonly string $binary;

    /**
     * @param non-empty-string|null $root
     * @param non-empty-string|null $app
     * @param non-empty-string|null $storage
     * @param non-empty-string|null $config
     * @param non-empty-string|null $vendor
     * @param non-empty-string|null $binary
     * @param PathDelimiterType $delimiter
     */
    public function __construct(
        string $root = null,
        string $app = null,
        string $storage = null,
        string $config = null,
        string $vendor = null,
        string $binary = null,
        string $delimiter = self::DEFAULT_DELIMITER,
    ) {
        parent::__construct($root, $app, $storage, $config, $vendor, $delimiter);

        $this->binary = $binary ?: $this->root('bin', \PHP_INT_SIZE === 8 ? 'x64' : 'x86');
    }

    /**
     * @param non-empty-string ...$suffix
     * @return non-empty-string
     */
    public function binary(string ...$suffix): string
    {
        return $this->to($this->binary, ...$suffix);
    }
}
