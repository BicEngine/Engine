<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Async;

final class Coroutine
{
    /**
     * @template TKey of mixed
     * @template TValue of mixed
     * @template TSend of mixed
     * @template TReturn of mixed
     *
     * @param \Generator<TKey, TValue, TSend, TReturn>|\Closure():\Generator<TKey, TValue, TSend, TReturn> $coroutine
     * @return \Fiber<TKey, TValue, TSend, TReturn>
     */
    public static function toFiber(\Generator|\Closure $coroutine): \Fiber
    {
        if ($coroutine instanceof \Closure) {
            $coroutine = $coroutine();

            if (!$coroutine instanceof \Generator) {
                $message = 'Argument #0 ($coroutine) of type Closure must return Generator, but %s has been returned';
                throw new \InvalidArgumentException(\sprintf($message, \get_debug_type($coroutine)));
            }
        }

        return new \Fiber(static function () use ($coroutine) {
            while ($coroutine->valid()) {
                $coroutine->send(\Fiber::suspend($coroutine->current()));
            }

            return $coroutine->getReturn();
        });
    }
}
