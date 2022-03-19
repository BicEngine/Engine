<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Window\Event;

use Bic\Ui\Window\WindowInterface;

final class WindowRename extends WindowEvent
{
    /**
     * @param WindowInterface $target
     * @param string $name
     * @param int|float|null $time
     */
    public function __construct(
        WindowInterface $target,
        public string $name,
        int|float|null $time = null
    ) {
        parent::__construct($target, $time);
    }
}
