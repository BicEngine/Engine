<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window\Event;

use Bic\Dispatcher\Event;
use Bic\Ui\Window\WindowEventInterface;
use Bic\Ui\Window\WindowInterface;

/**
 * @property-read WindowInterface $target
 * @template-extends Event<WindowInterface>
 */
abstract class WindowEvent extends Event implements WindowEventInterface
{
    /**
     * @param WindowInterface $target
     * @param int|float|null $time
     */
    public function __construct(WindowInterface $target, int|float|null $time = null)
    {
        parent::__construct($target, $time);
    }
}
