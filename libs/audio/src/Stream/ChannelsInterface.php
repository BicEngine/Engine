<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Stream;

interface ChannelsInterface extends \Countable
{
    /**
     * Returns count of the audio channels
     *
     * @return positive-int
     */
    public function count(): int;
}
