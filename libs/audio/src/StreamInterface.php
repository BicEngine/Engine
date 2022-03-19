<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio;

use Bic\Audio\Stream\FileSourceInterface;
use Bic\Audio\Stream\FrequencyInterface;
use Bic\Audio\Stream\SourceInterface;
use Bic\Audio\Stream\ChannelsInterface;
use Bic\Collection\SetInterface;

interface StreamInterface
{
    /**
     * @return FrequencyInterface
     */
    public function getFrequency(): FrequencyInterface;

    /**
     * @return SetInterface<SourceInterface>
     */
    public function getSources(): SetInterface;

    /**
     * @psalm-taint-sink file $pathname
     * @param non-empty-string $pathname
     * @return FileSourceInterface
     */
    public function addSourceByPathname(string $pathname): FileSourceInterface;

    /**
     * @return ChannelsInterface
     */
    public function getChannels(): ChannelsInterface;

    /**
     * @param bool $repeat
     * @return void
     */
    public function play(bool $repeat = false): void;

    /**
     * @return void
     */
    public function pause(): void;

    /**
     * @return void
     */
    public function stop(): void;
}
