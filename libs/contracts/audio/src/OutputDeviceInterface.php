<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Audio;

use Bic\Contracts\Audio\Stream\Channels;
use Bic\Contracts\Audio\Stream\ChannelsInterface;
use Bic\Contracts\Audio\Stream\Frequency;
use Bic\Contracts\Audio\Stream\FrequencyInterface;

interface OutputDeviceInterface extends DeviceInterface
{
    /**
     * @return list<StreamInterface>
     */
    public function getStreams(): iterable;

    /**
     * @param FrequencyInterface $frequency
     * @param ChannelsInterface $channels
     * @return StreamInterface
     */
    public function createStream(
        FrequencyInterface $frequency = Frequency::DVD,
        ChannelsInterface $channels = Channels::STEREO,
    ): StreamInterface;
}
