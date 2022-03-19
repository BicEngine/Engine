<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot\Extension;

interface VersionInterface extends \Stringable
{
    /**
     * @return positive-int
     */
    public function getMajor(): int;

    /**
     * @return positive-int
     */
    public function getMinor(): int;

    /**
     * @return positive-int
     */
    public function getPatch(): int;
}
