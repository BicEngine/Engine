<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio;

use Bic\Audio\Stream\Frequency;
use Bic\Audio\Stream\FrequencyInterface;
use Bic\Audio\Stream\Channels;
use Bic\Audio\Stream\ChannelsInterface;
use Bic\Collection\SetInterface;

interface OutputDeviceInterface extends DeviceInterface
{
    /**
     * @return SetInterface<StreamInterface>
     */
    public function getStreams(): SetInterface;

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
