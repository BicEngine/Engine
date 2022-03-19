<?php

/**
 * This file is part of Bic package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native\Internal;

use FFI\CData;
use FFI\Proxy\Proxy;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @method CData GetModuleHandleA(string|CData|null $name)
 * @method CData GetModuleHandleW(string|CData|null $name)
 */
class Kernel32 extends Proxy
{
    /**
     * @var non-empty-string
     */
    private const DEFAULT_PATH_HEADERS = __DIR__ . '/../../resources/headers/kernel32.h';

    /**
     * @var non-empty-string
     */
    private const DEFAULT_PATH_BINARY = 'kernel32.dll';

    /**
     * @psalm-suppress MixedAssignment
     */
    public function __construct()
    {
        $this->ffi = \FFI::cdef(
            \file_get_contents(self::DEFAULT_PATH_HEADERS),
            self::DEFAULT_PATH_BINARY
        );
    }
}
