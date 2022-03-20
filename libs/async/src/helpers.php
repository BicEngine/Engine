<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Bic\Async\Coroutine;

if (!function_exists('fiber_to_coroutine')) {
    /**
     * @see Coroutine::fromFiber()
     */
    function fiber_to_coroutine(Fiber|Closure $fiber): \Generator
    {
        return Coroutine::fromFiber($fiber);
    }
}

if (!function_exists('coroutine_to_fiber')) {
    /**
     * @see Coroutine::toFiber()
     */
    function coroutine_to_fiber(Generator|Closure $coroutine): \Fiber
    {
        return Coroutine::toFiber($coroutine);
    }
}
