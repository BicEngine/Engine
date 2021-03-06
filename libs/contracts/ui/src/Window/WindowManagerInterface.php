<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Ui\Window;

use Bic\Contracts\Dispatcher\ListenerInterface;
use Bic\Ui\Window\Event\WindowEvent;
use Bic\Ui\Window\WindowCreateInfo;

/**
 * @template T of WindowInterface
 * @template-extends \Traversable<array-key, T>
 * @template-extends ListenerInterface<WindowEvent>
 */
interface WindowManagerInterface extends ListenerInterface, \Traversable, \Countable
{
    /**
     * @param WindowCreateInfo $info
     * @return T
     */
    public function create(WindowCreateInfo $info = new WindowCreateInfo()): WindowInterface;
}
