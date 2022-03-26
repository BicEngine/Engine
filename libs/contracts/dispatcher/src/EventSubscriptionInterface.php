<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Contracts\Dispatcher;

/**
 * @template T of EventInterface
 * @template-extends DispatcherInterface<T>
 */
interface EventSubscriptionInterface extends DispatcherInterface, \Stringable
{
    /**
     * @return non-empty-string
     */
    public function getId(): string;

    /**
     * @return positive-int|0
     */
    public function getExecutionsNumber(): int;

    /**
     * @return void
     */
    public function cancel(): void;
}
