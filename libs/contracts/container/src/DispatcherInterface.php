<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Container;

use Bic\Contracts\Container\Exception\InvocationExceptionInterface;

interface DispatcherInterface
{
    /**
     * @param string|callable $fn
     * @return callable(): mixed
     */
    public function detach(string|callable $fn): callable;

    /**
     * @param string|callable $fn
     * @return mixed
     * @throws InvocationExceptionInterface
     */
    public function call(string|callable $fn): mixed;
}
