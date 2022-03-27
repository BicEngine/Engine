<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Ui\Window;

use Bic\Contracts\Dispatcher\ListenerInterface;

/**
 * @template-extends ListenerInterface<WindowEventInterface>
 */
interface WindowInterface extends ListenerInterface
{
    /**
     * @var positive-int
     * @final
     */
    public const DEFAULT_WIDTH = 640;

    /**
     * @var positive-int
     * @final
     */
    public const DEFAULT_HEIGHT = 480;

    /**
     * @return non-empty-string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array { 0: positive-int, 1: positive-int }
     */
    public function getSize(): array;

    /**
     * @return array { 0: int, 1: int }
     */
    public function getPosition(): array;

    /**
     * @param string|null $name New window name or reset to default
     * @return void
     */
    public function rename(string $name = null): void;

    /**
     * @param positive-int|null $width
     * @param positive-int|null $height
     * @return void
     */
    public function resize(int $width = null, int $height = null): void;

    /**
     * @param int|null $x
     * @param int|null $y
     * @return void
     */
    public function move(int $x = null, int $y = null): void;

    /**
     * @return void
     */
    public function show(): void;

    /**
     * @return void
     */
    public function hide(): void;

    /**
     * @return void
     */
    public function close(): void;
}
