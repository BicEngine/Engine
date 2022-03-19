<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Collection;

/**
 * @template T of mixed
 * @template-extends Set<T>
 * @template-implements MutableSetInterface<T>
 */
class MutableSet extends Set implements MutableSetInterface
{
    /**
     * @param mixed $e
     * @return bool
     */
    public function add(mixed $e): bool
    {
        if (! $this->contains($e)) {
            $this->items[] = $e;
            return true;
        }

        return false;

    }
}
