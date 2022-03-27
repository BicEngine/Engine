<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass\Stream;

use Bic\Contracts\Audio\Stream\FileSourceInterface;

final class FileSource implements FileSourceInterface
{
    /**
     * @param int $id
     * @param string $pathname
     */
    public function __construct(
        public readonly int $id,
        public readonly string $pathname,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPathname(): string
    {
        return $this->pathname;
    }
}
