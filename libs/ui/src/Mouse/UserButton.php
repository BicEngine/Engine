<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Mouse;

/**
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Mouse
 */
final class UserButton implements ButtonInterface
{
    /**
     * @param positive-int $id
     */
    public function __construct(private int $id)
    {
        assert($id > Button::LAST, 'Button ID must be greater than ' . Button::LAST);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        return $this->id;
    }
}
