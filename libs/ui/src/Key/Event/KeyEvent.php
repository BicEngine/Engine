<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Key\Event;

use Bic\Contracts\Ui\Key\KeyInterface;
use Bic\Contracts\Ui\Window\WindowEventInterface;
use Bic\Contracts\Ui\Window\WindowInterface;
use Bic\Dispatcher\Event;
use Bic\Ui\Key\Mode;

/**
 * @property-read WindowInterface $target
 * @template-extends Event<WindowInterface>
 *
 * @psalm-type GetKeyState = \Closure(Mode): bool
 */
abstract class KeyEvent extends Event implements WindowEventInterface
{
    /**
     * @param WindowInterface $target
     * @param KeyInterface $key
     * @param GetKeyState $keyState
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public KeyInterface $key,
        private \Closure $keyState,
        int|float|null $time = null
    ) {
        parent::__construct($target, $time);
    }

    /**
     * @param Mode $mode
     * @return bool
     */
    public function isPressed(Mode $mode): bool
    {
        return ($this->keyState)($mode);
    }
}
