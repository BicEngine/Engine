<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Desktop;

use Bic\Dispatcher\Exception\ListenerException;
use Bic\Foundation\Application as BaseApplication;
use Bic\Loop\Event\LoopStart;
use Bic\Loop\LoopInterface;
use Bic\Ui\Window\Event\WindowClose;
use Bic\Ui\Window\WindowInterface;
use Bic\Ui\Window\WindowManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Application extends BaseApplication
{
    /**
     * {@inheritDoc}
     */
    public function __construct(CreateInfo $info)
    {
        parent::__construct($info);
    }

    /**
     * @return int
     */
    public function run(): int
    {
        parent::run();

        $this->dispatchRunningEvent();

        try {
            return 0;
        } finally {
            $this->dispatchTerminatingEvent();
        }
    }
}
