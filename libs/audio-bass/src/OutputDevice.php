<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass;

use Bic\Audio\Bass\Library\Bass;
use Bic\Audio\Bass\Library\Mix;
use Bic\Collection\MutableSet;
use Bic\Collection\SetInterface;
use Bic\Contracts\Audio\Device\TypeInterface;
use Bic\Contracts\Audio\OutputDeviceInterface;
use Bic\Contracts\Audio\Stream\Channels;
use Bic\Contracts\Audio\Stream\ChannelsInterface;
use Bic\Contracts\Audio\Stream\Frequency;
use Bic\Contracts\Audio\Stream\FrequencyInterface;
use Bic\Contracts\Audio\StreamInterface;

final class OutputDevice implements OutputDeviceInterface
{
    /**
     * @var MutableSet<Stream>
     */
    private readonly MutableSet $streams;

    /**
     * @var bool
     */
    private bool $initialized = false;

    /**
     * @param Bass $bass
     * @param Mix $mix
     * @param non-empty-string $name
     * @param SetInterface<TypeInterface> $type
     * @param positive-int $id
     * @param non-empty-string $driver
     */
    public function __construct(
        private readonly Bass $bass,
        private readonly Mix $mix,
        private readonly string $name,
        private readonly SetInterface $type,
        private readonly int $id,
        private readonly string $driver,
    ) {
        $this->streams = new MutableSet();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): SetInterface
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function getStreams(): SetInterface
    {
        return $this->streams;
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function bootIfNotBooted(): void
    {
        if ($this->initialized === false) {
            if (!$this->bass->BASS_Init($this->id, 44100, 0, null, null)) {
                $code = $this->bass->BASS_ErrorGetCode();
                $message = 'An error [0x%08x] occurred while initializing audio engine';
                throw new \Exception(\sprintf($message, $code), $code);
            }

            $this->initialized = true;
        }
    }

    /**
     * @param FrequencyInterface $frequency
     * @param ChannelsInterface $channels
     * @return StreamInterface
     * @throws \Exception
     */
    public function createStream(
        FrequencyInterface $frequency = Frequency::DVD,
        ChannelsInterface $channels = Channels::STEREO,
    ): StreamInterface {
        $this->bootIfNotBooted();

        $channel = new Stream($this->bass, $this->mix, $this, $frequency, $channels);

        $this->streams->add($channel);

        return $channel;
    }
}
