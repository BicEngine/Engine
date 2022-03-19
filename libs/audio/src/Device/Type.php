<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Device;

enum Type: string implements TypeInterface
{
    case NETWORK = 'Network';
    case SPEAKERS = 'Speakers';
    case LINE = 'Line';
    case HEADPHONES = 'Headphones';
    case MICROPHONE = 'Microphone';
    case HEADSET = 'Headset';
    case HANDSET = 'Handset';
    case DIGITAL = 'Digital';
    case SPDIF = 'SPDIF';
    case HDMI = 'HDMI';
    case DISPLAYPORT = 'DisplayPort';

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->value;
    }
}
