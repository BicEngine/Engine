<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Desktop;

use Bic\Foundation\Application as BaseApplication;

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
