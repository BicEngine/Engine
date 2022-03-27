<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Ui\Win32;

use Bic\Contracts\Ui\Window\WindowInterface;
use FFI\CData;

interface Win32WindowInterface extends WindowInterface
{
    /**
     * Returns window HWND struct pointer.
     *
     * @link https://docs.microsoft.com/en-us/cpp/mfc/relationship-between-a-cpp-window-object-and-an-hwnd?view=msvc-160
     * @return CData
     */
    public function getHWnd(): CData;
}
