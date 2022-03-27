<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\SDL\Library;

use FFI\Contracts\Preprocessor\Exception\DirectiveDefinitionExceptionInterface;
use FFI\Headers\SDL2 as SDL2Header;
use FFI\Proxy\Proxy;

final class SDL2 extends Proxy
{
    /**
     * @psalm-taint-sink file $library
     * @param non-empty-string $library
     * @throws DirectiveDefinitionExceptionInterface
     */
    public function __construct(string $library)
    {
        $headers = SDL2Header::create(match (\PHP_OS_FAMILY) {
            'Windows' => SDL2Header\Platform::WINDOWS,
            'Linux' => SDL2Header\Platform::LINUX,
            'Darwin' => SDL2Header\Platform::DARWIN,
        });

        parent::__construct(\FFI::cdef((string)$headers, $library));
    }
}
