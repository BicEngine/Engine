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
 * @template-extends SetInterface<array-key, T>
 */
interface MutableSetInterface extends SetInterface
{
    /**
     * Adds the specified element to the set.
     *
     * @param T $e
     * @return bool Returns {@see true} if the element has been
     *         added, {@see false} if the element is already contained
     *         in the set.
     */
    public function add(mixed $e): bool;
}
