<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Mouse;

use Bic\Contracts\Ui\Mouse\ButtonInterface;

enum Button: int implements ButtonInterface
{
    /**
     * Primary button (usually the left button).
     *
     * @var positive-int|0
     */
    case LEFT = 0x00;

    /**
     * Secondary button (usually the right button).
     *
     * @var positive-int|0
     */
    case RIGHT = 0x01;

    /**
     * Auxiliary button (usually the mouse wheel button or middle button).
     *
     * @var positive-int|0
     */
    case MIDDLE = 0x02;

    /**
     * Last predefined button.
     *
     * @var positive-int|0
     */
    public const LAST = 0x02;

    /**
     * @param positive-int|0 $id
     * @return ButtonInterface
     */
    public static function create(int $id): ButtonInterface
    {
        return self::tryFrom($id) ?? new UserButton($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->value;
    }
}
