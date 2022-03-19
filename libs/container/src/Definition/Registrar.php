<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Container\Definition;

use Bic\Container\RegistrarInterface;
use Bic\Contracts\Container\Definition\DefinitionRegistrarInterface;

class Registrar implements DefinitionRegistrarInterface
{
    /**
     * @var string
     */
    private const ERROR_INVALID_DEFINITION = 'Service "%s" is not a valid class or interface name';

    /**
     * @param class-string|string $id
     */
    public function __construct(
        private string $id,
        private RegistrarInterface $registrar,
    ) {
    }

    /**
     * @param string ...$aliases
     * @return $this
     */
    public function as(string ...$aliases): self
    {
        foreach ($aliases as $alias) {
            $this->registrar->alias($this->id, $alias);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInterfaces(): self
    {
        if (! \class_exists($this->id) && ! \interface_exists($this->id)) {
            throw new \LogicException(\sprintf(self::ERROR_INVALID_DEFINITION, $this->id));
        }

        return $this->as(...\class_implements($this->id));
    }
}
