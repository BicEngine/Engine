<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass;

use Bic\Audio\DriverInterface;
use Bic\Boot\Attribute\Info;
use Bic\Boot\Attribute\Singleton;
use Bic\Foundation\Desktop\Path;

#[Info(
    name: 'Bass Audio Extension',
    description: 'Provides a cross-platform implementation of an audio driver '
        . 'using the Bass (https://un4seen.com) audio library'
)]
final class AudioExtension
{
    /**
     * @return non-empty-string
     */
    private function getBassLibrary(): string
    {
        return $_SERVER['LIB_BASS']
            ?? match (\PHP_OS_FAMILY) {
                'Windows' => 'bass.dll',
                'Linux' => 'libbass.so',
                'Darwin' => 'libbass.dylib',
            };
    }

    /**
     * @return non-empty-string
     */
    private function getBassMixLibrary(): string
    {
        return $_SERVER['LIB_BASS_MIX']
            ?? match (\PHP_OS_FAMILY) {
                'Windows' => 'bassmix.dll',
                'Linux' => 'libbassmix.so',
                'Darwin' => 'libbassmix.dylib',
            };
    }

    /**
     * @param Path $path
     * @return DriverInterface
     */
    #[Singleton]
    public function getAudioDriver(Path $path): DriverInterface
    {
        $bass = $this->getBassLibrary();
        $mix = $this->getBassMixLibrary();

        if (!\is_file($path->binary($bass))) {
            throw new \LogicException('Could not load [' . $bass . ']');
        }

        if (!\is_file($path->binary($mix))) {
            throw new \LogicException('Could not load [' . $mix . ']');
        }

        return new BassDriver($path->binary($bass), $path->binary($mix));
    }
}
