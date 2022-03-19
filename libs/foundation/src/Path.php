<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation;

/**
 * @psalm-type PathDelimiterType = non-empty-string
 */
class Path
{
    /**
     * @var PathDelimiterType
     */
    public const DEFAULT_DELIMITER = \DIRECTORY_SEPARATOR;

    /**
     * @var array<PathDelimiterType>
     */
    private const AVAILABLE_DELIMITERS = [ '/', '\\' ];

    /**
     * @var string
     */
    private const ERROR_ROOT_DIRECTORY = 'Can not determine application root directory';

    /**
     * @var non-empty-string
     */
    public readonly string $root;

    /**
     * @var non-empty-string
     */
    public readonly string $app;

    /**
     * @var non-empty-string
     */
    public readonly string $storage;

    /**
     * @var non-empty-string
     */
    public readonly string $config;

    /**
     * @var non-empty-string
     */
    public readonly string $vendor;

    /**
     * @param non-empty-string|null $root
     * @param non-empty-string|null $app
     * @param non-empty-string|null $storage
     * @param non-empty-string|null $config
     * @param non-empty-string|null $vendor
     * @param PathDelimiterType $delimiter
     */
    public function __construct(
        string $root = null,
        string $app = null,
        string $storage = null,
        string $config = null,
        string $vendor = null,
        private string $delimiter = self::DEFAULT_DELIMITER,
    ) {
        $this->root = $root ?: $this->resolveRootDirectory();
        $this->vendor = $vendor ?: $this->resolveVendorDirectory();

        $this->app = $app ?: $this->root('app');
        $this->storage = $storage ?: $this->root('storage');
        $this->config = $config ?: $this->root('resources', 'config');
    }

    /**
     * @param non-empty-string $prefix
     * @param non-empty-string ...$chunks
     * @return non-empty-string
     */
    protected function to(string $prefix, string ...$chunks): string
    {
        return self::join([$prefix, ...$chunks], $this->delimiter);
    }

    /**
     * @param non-empty-string ...$suffix
     * @return non-empty-string
     */
    public function root(string ...$suffix): string
    {
        return $this->to($this->root, ...$suffix);
    }

    /**
     * @param non-empty-string ...$suffix
     * @return non-empty-string
     */
    public function app(string ...$suffix): string
    {
        return $this->to($this->app, ...$suffix);
    }

    /**
     * @param non-empty-string ...$suffix
     * @return non-empty-string
     */
    public function storage(string ...$suffix): string
    {
        return $this->to($this->storage, ...$suffix);
    }

    /**
     * @param non-empty-string ...$suffix
     * @return non-empty-string
     */
    public function vendor(string ...$suffix): string
    {
        return $this->to($this->vendor, ...$suffix);
    }

    /**
     * @param non-empty-string ...$suffix
     * @return non-empty-string
     */
    public function config(string ...$suffix): string
    {
        return $this->to($this->config, ...$suffix);
    }

    /**
     * @param non-empty-string $path
     * @param PathDelimiterType $delimiter
     * @return non-empty-string
     */
    public static function normalize(string $path, string $delimiter = self::DEFAULT_DELIMITER): string
    {
        $path = \str_replace(self::AVAILABLE_DELIMITERS, $delimiter, $path);
        $double = $delimiter . $delimiter;

        do {
            $result = \str_replace($double, $delimiter, $path);

            if ($result === $path) {
                return $result;
            }

            $path = $result;
        } while (true);
    }

    /**
     * @param array<string> $parts
     * @param PathDelimiterType $delimiter
     * @return non-empty-string
     */
    public static function join(array $parts, string $delimiter = self::DEFAULT_DELIMITER): string
    {
        /** @psalm-suppress ArgumentTypeCoercion */
        return self::normalize(\implode($delimiter, \array_filter($parts)));
    }

    /**
     * @return non-empty-string
     */
    private function resolveRootDirectory(): string
    {
        return $_SERVER['DOCUMENT_ROOT']
            ?? \getcwd()
            ?: \dirname($_SERVER['SCRIPT_FILENAME'] ?? '')
            ?: throw new \InvalidArgumentException(self::ERROR_ROOT_DIRECTORY);
    }

    /**
     * @return non-empty-string
     */
    private function resolveVendorDirectory(): string
    {
        if (\class_exists(\Composer\Autoload\ClassLoader::class)) {
            $composer = (new \ReflectionClass(\Composer\Autoload\ClassLoader::class))->getFileName();

            return \dirname($composer, 2);
        }

        return $this->root('vendor');
    }
}