<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Key;

final class UserKey implements KeyInterface
{
    /**
     * @param int $code
     */
    public function __construct(
        private int $code
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getCode(): int
    {
        return $this->code;
    }
}
