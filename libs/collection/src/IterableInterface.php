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
 * @template TKey of mixed
 * @template TValue of mixed
 * @template-extends \Traversable<TKey, TValue>
 */
interface IterableInterface extends \Traversable, \Countable
{
}
