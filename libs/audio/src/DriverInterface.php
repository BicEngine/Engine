<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio;

use Bic\Collection\SetInterface;

/**
 * @template TDevice of OutputDeviceInterface
 */
interface DriverInterface
{
    /**
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * @return OutputDeviceInterface[]
     * @psalm-return SetInterface<TDevice>
     */
    public function getOutputDevices(): SetInterface;

    /**
     * @return TDevice
     */
    public function getDefaultOutputDevice(): OutputDeviceInterface;
}
