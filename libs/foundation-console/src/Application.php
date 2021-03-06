<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Console;

use Bic\Container\Exception\RegistrationException;
use Bic\Contracts\Container\Exception\NotInstantiatableExceptionInterface;
use Bic\Foundation\Application as BaseApplication;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Command\Command;

final class Application extends BaseApplication
{
    /**
     * @var SymfonyApplication
     */
    private SymfonyApplication $cli;

    /**
     * @var bool
     */
    private bool $running = false;

    /**
     * @param CreateInfo $info
     * @throws NotInstantiatableExceptionInterface
     * @throws RegistrationException
     */
    public function __construct(CreateInfo $info)
    {
        $info->container->instance(
            $this->cli = new SymfonyApplication($this->getName())
        );

        parent::__construct($info);
    }

    /**
     * @param Command ...$commands
     * @return void
     */
    public function add(Command ...$commands): void
    {
        if ($this->running) {
            throw new \LogicException('Can not add command to running CLI application');
        }

        $this->cli->addCommands($commands);
    }

    /**
     * @return string
     */
    protected function getName(): string
    {
        $version = $this->getVersion();

        if (\ctype_digit($version[0])) {
            $version = 'v' . $version;
        }

        return \sprintf('Bic Framework (%s)', $version);
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function run(): int
    {
        parent::run();

        try {
            $this->running = true;
            $this->dispatchRunningEvent();

            return $this->cli->run();
        } finally {
            $this->running = false;
            $this->dispatchTerminatingEvent();
        }
    }
}
