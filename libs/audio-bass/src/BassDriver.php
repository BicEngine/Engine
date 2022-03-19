<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass;

use Bic\Audio\Device\Type;
use Bic\Audio\Device\TypeInterface;
use Bic\Audio\DriverInterface;
use Bic\Collection\Set;
use Bic\Collection\SetInterface;
use FFI\CData;
use FFI\Env\Runtime;

/**
 * @template-implements DriverInterface<OutputDevice>
 */
final class BassDriver implements DriverInterface
{
    /**
     * @var non-empty-array<int, TypeInterface>
     */
    private const TYPE_MAPPING = [
        Bass::DEVICE_TYPE_NETWORK => Type::NETWORK,
        Bass::DEVICE_TYPE_SPEAKERS => Type::SPEAKERS,
        Bass::DEVICE_TYPE_LINE => Type::LINE,
        Bass::DEVICE_TYPE_HEADPHONES => Type::HEADPHONES,
        Bass::DEVICE_TYPE_MICROPHONE => Type::MICROPHONE,
        Bass::DEVICE_TYPE_HEADSET => Type::HEADSET,
        Bass::DEVICE_TYPE_HANDSET => Type::HANDSET,
        Bass::DEVICE_TYPE_DIGITAL => Type::DIGITAL,
        Bass::DEVICE_TYPE_SPDIF => Type::SPDIF,
        Bass::DEVICE_TYPE_HDMI => Type::HDMI,
        Bass::DEVICE_TYPE_DISPLAYPORT => Type::DISPLAYPORT,
    ];

    /**
     * @var SetInterface<OutputDevice>|null
     */
    private ?SetInterface $devices = null;

    /**
     * @var OutputDevice|null
     */
    private ?OutputDevice $default = null;

    /**
     * @var Bass|null
     */
    private ?Bass $bass = null;

    /**
     * @var Mix|null
     */
    private ?Mix $mix = null;

    /**
     * @psalm-taint-sink file $bassBinary
     * @psalm-taint-sink file $bassMixBinary
     * @param non-empty-string $bassBinary
     * @param non-empty-string $bassMixBinary
     */
    public function __construct(
        private readonly string $bassBinary,
        private readonly string $bassMixBinary,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function isAvailable(): bool
    {
        return \PHP_OS_FAMILY === 'Windows' && Runtime::isAvailable();
    }

    /**
     * @return Bass
     */
    private function bass(): Bass
    {
        return $this->bass ??= new Bass($this->bassBinary);
    }

    /**
     * @return Mix
     */
    private function mix(): Mix
    {
        return $this->mix ??= new Mix($this->bassMixBinary);
    }

    /**
     * {@inheritDoc}
     * @psalm-suppress all
     *
     */
    public function getOutputDevices(): SetInterface
    {
        return $this->devices ??= Set::fromIterable(function (): iterable {
            $bass = $this->bass();

            $bass->BASS_SetConfig(Bass::CONFIG_UNICODE, 1);
            $bass->BASS_SetVolume(1);

            foreach ($this->enumerate($bass) as $id => $info) {
                $output = new OutputDevice(
                    bass: $bass,
                    mix: $this->mix(),
                    name: $info->name,
                    type: $this->detectDeviceType($info->flags),
                    id: $id,
                    driver: $info->driver
                );

                if ((Bass::DEVICE_DEFAULT & $info->flags) === Bass::DEVICE_DEFAULT) {
                    $this->default = $output;
                }

                yield $output;
            }
        });
    }

    /**
     * @param int $flags
     * @return SetInterface<TypeInterface>
     */
    private function detectDeviceType(int $flags): SetInterface
    {
        return Set::fromIterable(static function () use ($flags): iterable {
            foreach (self::TYPE_MAPPING as $flag => $case) {
                if (($flags & $flag) === $flag) {
                    yield $case;
                }
            }
        });
    }

    /**
     * @param Bass $bass
     * @psalm-return iterable<int, CData>
     * @return iterable<int, CData|\Bic\FFI\Bass\BASS_DEVICEINFO>
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress PossiblyNullArgument
     */
    private function enumerate(Bass $bass): iterable
    {
        $info = $bass->new('BASS_DEVICEINFO');
        for ($i = 0; $bass->BASS_GetDeviceInfo($i, \FFI::addr($info)); ++$i) {
            if (
                // Is physical device
                (Bass::DEVICE_TYPE_MASK & $info->flags) === 0
                // Is enabled
                && (Bass::DEVICE_ENABLED & $info->flags) === Bass::DEVICE_ENABLED
            ) {
                continue;
            }

            yield $i => $info;
        }
    }

    /**
     * @return OutputDevice
     * @throws \Exception
     */
    public function getDefaultOutputDevice(): OutputDevice
    {
        if ($this->default !== null) {
            return $this->default;
        }

        // Boot all output devices
        $first = null;
        foreach ($this->getOutputDevices() as $device) {
            $first ??= $device;
        }

        /** @psalm-suppress TypeDoesNotContainType */
        return $this->default ?? $first ?? throw new \Exception('Could not to get default output device');
    }
}
