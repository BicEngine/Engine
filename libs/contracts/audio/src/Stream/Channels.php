<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Audio\Stream;

enum Channels: int implements ChannelsInterface
{
    case MONO = 1;
    case STEREO = 2;
    case QUAD = 4;
    case MULTI51 = 6;
    case MULTI71 = 8;

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return $this->value;
    }
}
