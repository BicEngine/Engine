<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Audio;

use Bic\Contracts\Audio\Stream\ChannelsInterface;
use Bic\Contracts\Audio\Stream\FileSourceInterface;
use Bic\Contracts\Audio\Stream\FrequencyInterface;
use Bic\Contracts\Audio\Stream\SourceInterface;

interface StreamInterface
{
    /**
     * @return FrequencyInterface
     */
    public function getFrequency(): FrequencyInterface;

    /**
     * @return list<SourceInterface>
     */
    public function getSources(): iterable;

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
