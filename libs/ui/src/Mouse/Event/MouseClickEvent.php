<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Mouse\Event;

use Bic\Ui\Mouse\ButtonInterface;
use Bic\Ui\Window\WindowInterface;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Mouse
 */
abstract class MouseClickEvent extends MouseEvent
{
    /**
     * @param WindowInterface $target
     * @param ButtonInterface $button
     * @param int $x
     * @param int $y
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public ButtonInterface $button,
        int $x = 0,
        int $y = 0,
        int|float|null $time = null
    ) {
        parent::__construct($target, $x, $y, $time);
    }
}
