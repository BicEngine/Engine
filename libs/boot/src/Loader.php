<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot;

use Bic\Boot\Attribute\ServiceDefinition;
use Bic\Boot\Attribute\Registration;
use Bic\Container\Container;
use Bic\Container\Exception\RegistrationException;
use Bic\Container\ParamResolver\Renderer;
use Bic\Contracts\Container\Definition\DefinitionInterface;

class Loader implements RepositoryInterface, LoaderInterface
{
    /**
     * @var non-empty-string
     */
    private const ERROR_ID_NOT_DEFINED =
        'Can not register the service from %s, identifier is missing. ' .
        'Please provide id explicitly using the attribute argument or define ' .
        'an unambiguous return type';

    /**
     * @var non-empty-string
     */
    private const ERROR_AMBIGUOUS_IDENTIFIER =
        'Can not register the service from %s, identifier is ambiguous. ' .
        'Please provide id explicitly using the attribute argument or define ' .
        'an unambiguous return type';

    /**
     * @var array<ExtensionInterface>
     */
    private array $extensions = [];

    /**
     * @var array<array{Registration, \Closure}>
     */
    private array $registrable = [];

    /**
     * @param Container $container
     */
    public function __construct(
        private readonly Container $container
    ) {
    }

    /**
     * @param object $extension
     * @throws RegistrationException
     */
    public function load(object $extension): void
    {
        $loaded = new Extension($extension);

        foreach ($this->lookupDefinitions($loaded) as $attr => $definition) {
            /** @psalm-suppress PossiblyNullArgument */
            $this->container->define($attr->id, $definition)
                ->as(...$attr->aliases)
            ;
        }

        foreach ($this->lookupRegistrars($loaded) as $attr => $action) {
            $this->registrable[] = [$attr, $action];
        }

        $this->extensions[] = $loaded;
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        while ($this->registrable !== []) {
            [$attr, $action] = \array_shift($this->registrable);

            if ($attr->isRunnable($this->container)) {
                $this->container->call($action);
            }
        }
    }

    /**
     * @param ExtensionInterface $provider
     * @return iterable<ServiceDefinition, DefinitionInterface>
     * @throws RegistrationException
     */
    private function lookupDefinitions(ExtensionInterface $provider): iterable
    {
        /**
         * @var \ReflectionMethod $method
         * @var ServiceDefinition $attribute
         */
        foreach ($provider->getMethodMetadata(ServiceDefinition::class) as $method => $attribute) {
            $declarator = $method->getClosure(
                $provider->getContext()
            );

            $attribute->id ??= $this->getIdFromMethodDefinition($method);

            yield $attribute => $attribute->create($attribute->id, $this->container, $declarator);
        }
    }

    /**
     * @param ExtensionInterface $provider
     * @return iterable<Registration, \Closure>
     */
    private function lookupRegistrars(ExtensionInterface $provider): iterable
    {
        foreach ($provider->getMethodMetadata(Registration::class) as $method => $attribute) {
            yield $attribute => $method->getClosure(
                $provider->getContext()
            );
        }
    }

    /**
     * @param \ReflectionMethod $method
     * @return non-empty-string
     * @throws RegistrationException
     */
    private function getIdFromMethodDefinition(\ReflectionMethod $method): string
    {
        $type = $method->getReturnType();

        if ($type === null) {
            throw new RegistrationException(
                \sprintf(self::ERROR_ID_NOT_DEFINED, Renderer::functionToString($method))
            );
        }

        if ($type instanceof \ReflectionNamedType) {
            return $type->getName();
        }

        throw new RegistrationException(
            \sprintf(self::ERROR_AMBIGUOUS_IDENTIFIER, Renderer::functionToString($method))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getExtensions(): iterable
    {
        return $this->extensions;
    }
}
