<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\ErrorHandler;

/**
 * @package error-handler
 */
interface ErrorHandlerInterface
{
    /**
     * @param \Throwable $e
     * @return mixed
     */
    public function throw(\Throwable $e): mixed;
}
