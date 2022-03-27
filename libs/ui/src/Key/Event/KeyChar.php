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
use Bic\Contracts\Ui\Window\WindowInterface;

/**
 * @psalm-import-type GetKeyState from KeyEvent
 */
class KeyChar extends KeyEvent
{
    /**
     * @param WindowInterface $target
     * @param string $char
     * @param KeyInterface $key
     * @param \Closure $keyState
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public string $char,
        KeyInterface $key,
        \Closure $keyState,
        int|float|null $time = null
    ) {
        parent::__construct($target, $key, $keyState, $time);
    }
}
