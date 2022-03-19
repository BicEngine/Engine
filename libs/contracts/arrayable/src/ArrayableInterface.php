<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Arrayable;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 */
interface ArrayableInterface
{
    /**
     * Converts object to array
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
