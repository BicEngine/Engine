<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Audio\Stream;

/**
 * This enumeration defines the overall frequency of the samples that
 * constitute the audio stream. For information on each type,
 * see ISO/IEC-61883-6.
 */
enum Frequency: int implements FrequencyInterface
{
    case HZ32000  = 32000;
    case HZ44100  = 44100;
    case HZ48000  = 48000;
    case HZ88200  = 88200;
    case HZ96000  = 96000;
    case HZ176400  = 176400;
    case HZ192000 = 192000;

    public const CD = self::HZ44100;
    public const DVD = self::HZ48000;
    public const STUDIO = self::HZ96000;
    public const STUDIO_HIGH = self::HZ192000;

    /**
     * {@inheritDoc}
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
