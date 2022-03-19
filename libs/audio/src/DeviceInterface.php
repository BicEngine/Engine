<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio;

use Bic\Collection\SetInterface;

/**
 * @template TType of TypeInterface
 */
interface DeviceInterface
{
    /**
     * @return non-empty-string
     */
    public function getName(): string;

    /**
     * @return SetInterface<TType>
     */
    public function getType(): SetInterface;
}
