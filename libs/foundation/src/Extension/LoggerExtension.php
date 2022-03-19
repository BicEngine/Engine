<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Extension;

use Bic\Boot\Attribute\Info;
use Bic\Boot\Attribute\Singleton;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

#[Info(
    name: 'Kernel Logger Extension',
    description: 'Provides basic empty binding for the PSR-3 logger interface',
)]
class LoggerExtension
{
    #[Singleton]
    public function getLogger(): LoggerInterface
    {
        return new NullLogger();
    }
}
