<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window;

use Bic\Dispatcher\ListenerInterface;
use Bic\Ui\Window\Event\WindowEvent;

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
