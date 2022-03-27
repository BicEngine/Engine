<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation;

use Bic\Contracts\Dispatcher\DispatcherInterface;
use Bic\Foundation\Event\Loading;
use Bic\Foundation\Event\Running;
use Composer\InstalledVersions;
use Bic\Boot\Loader;
use Bic\Boot\LoaderInterface;
use Bic\Boot\RepositoryInterface;
use Bic\Container\Container;
use Bic\Container\Exception\RegistrationException;
use Bic\Contracts\Container\Exception\NotInstantiatableExceptionInterface;

class Application implements LoaderInterface
{
    /**
     * @var Loader
     */
    private Loader $extensions;

    /**
     * @var Container
     */
    protected Container $container;

    /**
     * @var bool
     */
    protected bool $debug;

    /**
     * @param CreateInfo $info
     * @throws RegistrationException
     * @throws NotInstantiatableExceptionInterface
     */
    public function __construct(CreateInfo $info)
    {
        $this->debug = $info->debug;

        $this->container = $info->container;
        $this->container->instance($this);

        $this->bootPath($info);
        $this->bootExtensions($info);
    }

    /**
     * @param CreateInfo $info
     * @return void
     * @throws NotInstantiatableExceptionInterface
     * @throws RegistrationException
     */
    private function bootExtensions(CreateInfo $info): void
    {
        $this->extensions = new Loader($this->container);

        $this->container->instance($this->extensions)
            ->as(RepositoryInterface::class)
        ;

        foreach ($info->extensions as $extension) {
            if (\is_string($extension)) {
                $extension = $this->container->make($extension);
            }

            $this->load($extension);
        }
    }

    /**
     * @param CreateInfo $info
     * @return void
     */
    private function bootPath(CreateInfo $info): void
    {
        $this->container->instance($info->path);
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @return string
     */
    protected function getVersion(): string
    {
        return InstalledVersions::getPrettyVersion('bic-engine/foundation') ?? 'dev-master';
    }

    /**
     * @param object $extension
     * @throws RegistrationException
     */
    public function load(object $extension): void
    {
        $this->extensions->load($extension);
    }

    /**
     * @return int
     */
    public function run(): int
    {
        $this->dispatchLoadingEvent();
        $this->extensions->boot();

        return 0;
    }

    /**
     * @return void
     */
    protected function dispatchLoadingEvent(): void
    {
        $this->container->when(DispatcherInterface::class, fn (DispatcherInterface $dispatcher) =>
            $dispatcher->dispatch(new Loading($this))
        );
    }

    /**
     * @return void
     */
    protected function dispatchRunningEvent(): void
    {
        $this->container->when(DispatcherInterface::class, fn (DispatcherInterface $dispatcher) =>
            $dispatcher->dispatch(new Running($this))
        );
    }

    /**
     * @return void
     */
    protected function dispatchTerminatingEvent(): void
    {
        $this->container->when(DispatcherInterface::class, fn (DispatcherInterface $dispatcher) =>
            $dispatcher->dispatch(new Running($this))
        );
    }
}
