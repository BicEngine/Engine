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
 * @template-extends IterableInterface<array-key, T>
 */
interface SetInterface extends IterableInterface
{
    /**
     * Checks if the specified element is contained in this collection.
     *
     * @param T $item
     * @return bool
     */
    public function contains(mixed $item): bool;
}
