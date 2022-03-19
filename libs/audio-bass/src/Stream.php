<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass;

use Bic\Audio\Stream\FileSourceInterface;
use Bic\Audio\Stream\Frequency;
use Bic\Audio\Stream\FrequencyInterface;
use Bic\Audio\Stream\SourceInterface;
use Bic\Audio\Stream\Channels;
use Bic\Audio\Stream\ChannelsInterface;
use Bic\Audio\StreamInterface;
use Bic\Audio\Bass\Stream\FileSource;
use Bic\Collection\MutableSet;
use Bic\Collection\MutableSetInterface;
use Bic\Collection\SetInterface;

final class Stream implements StreamInterface
{
    /**
     * @var int
     */
    private readonly int $stream;

    /**
     * @var MutableSetInterface<SourceInterface>
     */
    public readonly MutableSetInterface $sources;

    /**
     * @param Bass $bass
     * @param Mix $mix
     * @param OutputDevice $device
     * @param FrequencyInterface $frequency
     * @param ChannelsInterface $channels
     * @throws \Exception
     */
    public function __construct(
        private readonly Bass $bass,
        private readonly Mix $mix,
        public readonly OutputDevice $device,
        public readonly FrequencyInterface $frequency = Frequency::DVD,
        public readonly ChannelsInterface $channels = Channels::STEREO,
    ) {
        $this->sources = new MutableSet();
        $this->stream = $mix->BASS_Mixer_StreamCreate(
            $frequency->getValue(),
            $channels->count(),
            Bass::SAMPLE_FLOAT
        );

        if (($error = $this->bass->BASS_ErrorGetCode()) !== Bass::OK) {
            $message = 'An error [0x%08x] occurred while creating audio channel';
            throw new \Exception(\sprintf($message, $error), $error);
        }

        $this->bass->BASS_ChannelSetDevice(
            $this->stream,
            $this->device->getId(),
        );

        if (($error = $this->bass->BASS_ErrorGetCode()) !== Bass::OK) {
            $message = 'An error [0x%08x] occurred while attaching audio channel';
            throw new \Exception(\sprintf($message, $error), $error);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getFrequency(): FrequencyInterface
    {
        return $this->frequency;
    }

    /**
     * {@inheritDoc}
     */
    public function getChannels(): ChannelsInterface
    {
        return $this->channels;
    }

    /**
     * {@inheritDoc}
     */
    public function getSources(): SetInterface
    {
        return $this->sources;
    }

    /**
     * {@inheritDoc}
     *
     * @param int $offset
     * @param int $length
     */
    public function addSourceByPathname(string $pathname, int $offset = 0, int $length = 0): FileSourceInterface
    {
        $stream = $this->bass->BASS_StreamCreateFile(0, $pathname, $offset, $length, Bass::STREAM_DECODE);

        return $this->add(new FileSource($stream, $pathname));
    }

    /**
     * @template T of SourceInterface
     *
     * @param T $source
     * @return T
     */
    private function add(SourceInterface $source): SourceInterface
    {
        $this->mix->BASS_Mixer_StreamAddChannel($this->stream, $source->getId(), Mix::MIXER_CHAN_BUFFER);

        $this->sources->add($source);

        return $source;
    }

    /**
     * {@inheritDoc}
     */
    public function play(bool $repeat = false): void
    {
        $this->bass->BASS_ChannelPlay($this->stream, (int)$repeat);
    }

    /**
     * {@inheritDoc}
     */
    public function pause(): void
    {
        $this->bass->BASS_ChannelPause($this->stream);
    }

    /**
     * {@inheritDoc}
     */
    public function stop(): void
    {
        $this->bass->BASS_ChannelStop($this->stream);
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->bass->BASS_StreamFree($this->stream);
    }
}
