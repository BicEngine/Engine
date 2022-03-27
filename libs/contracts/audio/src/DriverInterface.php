<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Audio;

/**
 * @template TDevice of OutputDeviceInterface
 */
interface DriverInterface
{
    /**
     * @return list<TDevice>
     */
    public function getOutputDevices(): iterable;

    /**
     * @return TDevice
     */
    public function getDefaultOutputDevice(): OutputDeviceInterface;
}
