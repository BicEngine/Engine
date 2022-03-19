<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Memoizable;

interface MemoizableInterface
{
    /**
     * Clears all memoized data.
     *
     * @return void
     */
    public function free(): void;
}
