<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Console\Extension;

use Bic\Boot\Attribute\Info;
use Bic\Boot\Attribute\Registration;
use Bic\Boot\RepositoryInterface;
use Bic\Foundation\Console\Command\ExtListCommand;
use Bic\Foundation\Path;
use Symfony\Component\Console\Application;

#[Info(name: 'Kernel Console Commands', description: 'Provides a list of basic kernel console commands')]
class ConsoleCommandsExtension
{
    #[Registration(ifServiceExists: Application::class)]
    public function addCommands(Application $cli, Path $path, RepositoryInterface $boot): void
    {
        $cli->add(new ExtListCommand($boot));
    }
}
