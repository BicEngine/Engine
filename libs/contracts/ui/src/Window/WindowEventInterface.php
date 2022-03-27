<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Ui\Window;

use Bic\Contracts\Dispatcher\EventInterface;

/**
 * @property-read WindowInterface $target
 * @template-extends EventInterface<WindowInterface>
 */
interface WindowEventInterface extends EventInterface
{
}
