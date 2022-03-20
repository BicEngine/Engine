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
     * @param ( \Fiber<TKey, TValue, TSend, TReturn>
     *        | \Closure(mixed...): TReturn ) $fiber
     * @return \Generator<TKey, TValue, TSend, TReturn>
     * @throws \Throwable
     *
     * @psalm-pure The result of this function always depends on the input
     *             arguments.
     * @psalm-suppress ImpureMethodCall: The presence of side effects inside
     *                 external calls does not mean that this particular
     *                 function is not pure.
     * @psalm-suppress TooManyTemplateParams: Psalm may not support Fiber
     *                 template parameters.
     * @psalm-suppress InvalidReturnType: In the case that the Psalm does not
     *                 support the template parameters of the Fiber, then this
     *                 error will occur.
     */
    public static function fromFiber(\Fiber|\Closure $fiber): \Generator
    {
        if ($fiber instanceof \Closure) {
            $fiber = new \Fiber($fiber);
        }

        $value = null;

        if (!$fiber->isStarted()) {
            $value = yield $fiber->start();
        }

        while ($fiber->isSuspended()) {
            $output = $fiber->resume($value);

            // The last value of a `$fiber->resume()` always returns `null`.
            // We can check that the value is the last one using the
            // `$fiber->isTerminated()` method.
            if (!$fiber->isTerminated()) {
                $value = yield $output;
            }
        }

        return $fiber->getReturn();
    }

    /**
     * @template TKey of mixed
     * @template TValue of mixed
     * @template TSend of mixed
     * @template TReturn of mixed
     *
     * @param ( \Closure(mixed...): \Generator<TKey, TValue, TSend, TReturn>
     *        | \Generator<TKey, TValue, TSend, TReturn> ) $coroutine
     * @return \Fiber<TKey, TValue, TSend, TReturn>
     *
     * @psalm-pure The result of this function always depends on the input
     *             arguments.
     * @psalm-suppress ImpureMethodCall: The presence of side effects inside
     *                 external calls does not mean that this particular
     *                 function is not pure.
     * @psalm-suppress TooManyTemplateParams: Psalm may not support Fiber
     *                 template parameters.
     */
    public static function toFiber(\Generator|\Closure $coroutine): \Fiber
    {
        $context = __METHOD__;

        return new \Fiber(static function (mixed ...$args) use ($context, $coroutine): mixed {
            if ($coroutine instanceof \Closure) {
                // We can only pass `Fiber::start()` arguments if the Coroutine
                // is inside an anonymous function, similar to the Fiber
                // constructor argument.
                $coroutine = $coroutine(...$args);

                /**
                 * @psalm-suppress DocblockTypeContradiction: In this case, type
                 *                 substitution occurs from an anonymous function,
                 *                 which violates the agreement in the docblock.
                 */
                if (!$coroutine instanceof \Generator) {
                    $message = $context . '(): Argument #1 ($coroutine) of type Closure must '
                        . 'return Generator, %s returned';
                    throw new \TypeError(\sprintf($message, \get_debug_type($coroutine)));
                }
            }

            while ($coroutine->valid()) {
                /**
                 * @psalm-suppress MixedArgument: In the case that the Psalm
                 *                 does not support the template parameters of
                 *                 the Fiber, then this error will occur.
                 */
                $coroutine->send(\Fiber::suspend($coroutine->current()));
            }

            return $coroutine->getReturn();
        });
    }
}
