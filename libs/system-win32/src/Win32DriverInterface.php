<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Win32;

use Bic\System\DriverInterface as BaseDriverInterface;

/**
 * @template T of Win32ProcessorInterface
 * @template-extends BaseDriverInterface<T>
 */
interface Win32DriverInterface extends BaseDriverInterface
{
}
