<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32;

use Bic\Ui\Window\WindowCreateInfo;
use Bic\Ui\Window\WindowManagerInterface;
use FFI\CData;

/**
 * @template T of Win32WindowInterface
 * @template-extends WindowManagerInterface<T>
 */
interface Win32WindowManagerInterface extends WindowManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(WindowCreateInfo $info = new WindowCreateInfo()): Win32WindowInterface;
}
