<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Config;

use Bic\Config\Exception\ValidationExceptionInterface;

interface ValidatorInterface
{
    /**
     * @param mixed $payload
     * @return list<ValidationExceptionInterface>|null
     */
    public function validate(mixed $payload): ?iterable;
}
