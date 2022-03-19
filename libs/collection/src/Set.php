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
 * @template-implements SetInterface<T>
 * @template-implements \IteratorAggregate<array-key, T>
 * @psalm-consistent-constructor
 */
class Set implements SetInterface, \IteratorAggregate
{
    /**
     * @var array<array-key, T>
     */
    protected array $items = [];

    /**
     * @var \Generator<array-key, T>|null
     */
    private ?\Generator $iterator = null;

    /**
     * @param iterable<array-key, T> $items
     */
    public function __construct(iterable $items = [])
    {
        if ($items instanceof \Traversable) {
            $this->iterator = $items;
        } else {
            $this->items = $items;
        }
    }

    /**
     * @template TValue of mixed
     *
     * @param iterable<array-key, TValue> $items
     * @return static<TValue>
     */
    public static function new(iterable $items = []): static
    {
        if ($items instanceof static) {
            return $items;
        }

        /** @psalm-suppress UnsafeGenericInstantiation */
        return new static($items);
    }

    /**
     * @template TReturn of mixed
     *
     * @param callable(): iterable<array-key, TReturn> $context
     * @return static<TReturn>
     */
    public static function fromIterable(callable $context): static
    {
        return static::new($context());
    }

    /**
     * {@inheritDoc}
     */
    public function contains(mixed $item): bool
    {
        if ($this->iterator !== null) {
            // Initialize
            \iterator_to_array($this);
        }

        return \in_array($item, $this->items, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        if ($this->iterator !== null) {
            while ($this->iterator->valid()) {
                $item = $this->iterator->current();

                if (! \in_array($item, $this->items, true)) {
                    $this->items[] = $item;
                }

                $this->iterator->next();
            }
        }

        return new \ArrayIterator($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        if ($this->iterator !== null) {
            return \iterator_count($this);
        }

        return \count($this->items);
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return \iterator_to_array($this);
    }
}
