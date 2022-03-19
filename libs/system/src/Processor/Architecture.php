<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Processor;

enum Architecture
{
    case X86;
    case AMD64;
    case ARM;
    case ARM64;
    case MIPS;
    case PPC;
    case UNKNOWN;
}
