<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Key;

enum Mode: int
{
    /**
     * If this bit is set one or more Shift keys were held down.
     *
     * @var positive-int
     */
    case SHIFT = 0x0001;

    /**
     * If this bit is set one or more Control keys were held down.
     *
     * @var positive-int
     */
    case CONTROL = 0x0002;

    /**
     * If this bit is set one or more Alt keys were held down.
     *
     * @var positive-int
     */
    case ALT = 0x0004;

    /**
     * If this bit is set one or more Super keys were held down.
     *
     * @var positive-int
     */
    case SUPER = 0x0008;

    /**
     * If this bit is set the Caps Lock key is enabled.
     *
     * @var positive-int
     */
    case CAPS_LOCK = 0x0010;

    /**
     * If this bit is set the Num Lock key is enabled.
     *
     * @var positive-int
     */
    case NUM_LOCK = 0x0020;
}
