<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System;

use Bic\Collection\SetInterface;

/**
 * @template T of ProcessorInterface
 */
interface DriverInterface
{
    /**
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * @return SetInterface<T>
     */
    public function getProcessors(): SetInterface;
}
