<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Win32\Native\Api;

use FFI\CData;
use FFI\Proxy\Proxy;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\System\Win32\Native
 *
 * @method void GetSystemInfo(\Bic\System\Win32\Native\SystemInfo|CData $info)
 * @method bool IsProcessorFeaturePresent(int $feature)
 */
class Kernel32 extends Proxy
{
    /**
     * @psalm-taint-sink file
     * @var non-empty-string
     */
    private const KERNEL32_HEADER = __DIR__ . '/../../resources/headers/kernel32.h';

    /**
     * Kernel32 class constructor.
     */
    public function __construct()
    {
        parent::__construct(\FFI::cdef(\file_get_contents(self::KERNEL32_HEADER), 'kernel32.dll'));
    }
}
