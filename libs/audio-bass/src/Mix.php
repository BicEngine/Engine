<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass;

use FFI\Contracts\Preprocessor\Exception\DirectiveDefinitionExceptionInterface;
use FFI\Contracts\Preprocessor\Exception\PreprocessorExceptionInterface;
use FFI\Headers\BassMix;
use FFI\Preprocessor\Preprocessor;
use FFI\Proxy\Proxy;

final class Mix extends Proxy
{
    public const CONFIG_MIXER_BUFFER = 0x10601;
    public const CONFIG_MIXER_POSEX = 0x10602;
    public const CONFIG_SPLIT_BUFFER = 0x10610;
    /** end the stream when there are no sources */
    public const MIXER_END = 0x10000;
    /** don't stall when there are no sources */
    public const MIXER_NONSTOP = 0x20000;
    /** resume stalled immediately upon new/unpaused source */
    public const MIXER_RESUME = 0x1000;
    /** enable BASS_Mixer_ChannelGetPositionEx support */
    public const MIXER_POSEX = 0x2000;
    /** start is an absolute position */
    public const MIXER_CHAN_ABSOLUTE = 0x1000;
    /** buffer data for BASS_Mixer_ChannelGetData/Level */
    public const MIXER_CHAN_BUFFER = 0x2000;
    /** limit mixer processing to the amount available from this source */
    public const MIXER_CHAN_LIMIT = 0x4000;
    /** matrix mixing */
    public const MIXER_CHAN_MATRIX = 0x10000;
    /** don't process the source */
    public const MIXER_CHAN_PAUSE = 0x20000;
    /** downmix to stereo/mono */
    public const MIXER_CHAN_DOWNMIX = 0x400000;
    /** don't ramp-in the start */
    public const MIXER_CHAN_NORAMPIN = 0x800000;
    public const MIXER_BUFFER = self::MIXER_CHAN_BUFFER;
    public const MIXER_LIMIT = self::MIXER_CHAN_LIMIT;
    public const MIXER_MATRIX = self::MIXER_CHAN_MATRIX;
    public const MIXER_PAUSE = self::MIXER_CHAN_PAUSE;
    public const MIXER_DOWNMIX = self::MIXER_CHAN_DOWNMIX;
    public const MIXER_NORAMPIN = self::MIXER_CHAN_NORAMPIN;
    public const ATTRIB_MIXER_LATENCY = 0x15000;
    public const ATTRIB_MIXER_THREADS = 0x15001;
    public const ACTIVE_WAITING = 5;
    /** only read buffered data */
    public const SPLIT_SLAVE = 0x1000;
    public const SPLIT_POS = 0x2000;
    public const ATTRIB_SPLIT_ASYNCBUFFER = 0x15010;
    public const ATTRIB_SPLIT_ASYNCPERIOD = 0x15011;
    public const MIXER_ENV_FREQ = 1;
    public const MIXER_ENV_VOL = 2;
    public const MIXER_ENV_PAN = 3;
    /**  flag: loop */
    public const MIXER_ENV_LOOP = 0x10000;
    /**  flag: remove at end */
    public const MIXER_ENV_REMOVE = 0x20000;
    public const SYNC_MIXER_ENVELOPE = 0x10200;
    public const SYNC_MIXER_ENVELOPE_NODE = 0x10201;
    public const POS_MIXER_RESET = 0x10000;
    public const POS_MIXER_DELAY = 5;
    public const CTYPE_STREAM_MIXER = 0x10800;
    public const CTYPE_STREAM_SPLIT = 0x10801;

    /**
     * @psalm-taint-sink file $library
     * @param non-empty-string $library
     * @throws DirectiveDefinitionExceptionInterface
     * @throws PreprocessorExceptionInterface
     */
    public function __construct(string $library)
    {
        $headers = BassMix::create(match (\PHP_OS_FAMILY) {
            'Windows' => BassMix\Platform::WINDOWS,
            'Linux' => BassMix\Platform::LINUX,
            'Darwin' => BassMix\Platform::DARWIN,
        });

        parent::__construct(\FFI::cdef((string)$headers, $library));
    }
}
