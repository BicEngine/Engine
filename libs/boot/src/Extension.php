<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Boot;

use Bic\Boot\Extension\Info\Factory;
use Bic\Boot\Extension\Metadata\AttributesMetadataProvider;
use Bic\Boot\Extension\Info\InfoProviderInterface;
use Bic\Boot\Extension\Metadata\MetadataProviderInterface;

final class Extension implements ExtensionInterface, \Stringable
{
    /**
     * @var MetadataProviderInterface|null
     */
    private ?MetadataProviderInterface $metadata = null;

    /**
     * @var InfoProviderInterface|null
     */
    private ?InfoProviderInterface $info = null;

    /**
     * @param object $context
     */
    public function __construct(
        private object $context
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getClassMetadata(string $attribute = null): iterable
    {
        $meta = $this->getMetadata();

        return $meta->getClassMetadata($attribute);
    }

    /**
     * @return MetadataProviderInterface
     */
    private function getMetadata(): MetadataProviderInterface
    {
        return $this->metadata ??= new AttributesMetadataProvider(
            new \ReflectionObject($this->getContext())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getContext(): object
    {
        return $this->context;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodMetadata(string $attribute = null): iterable
    {
        $meta = $this->getMetadata();

        return $meta->getMethodMetadata($attribute);
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'version' => $this->getVersion(),
        ];
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return \json_encode($this->toArray(), \JSON_THROW_ON_ERROR | \JSON_PRETTY_PRINT);
    }

    /**
     * @return InfoProviderInterface
     */
    private function getInfo(): InfoProviderInterface
    {
        $factory = new Factory($this->getMetadata());

        return $this->info ??= $factory->create(
            new \ReflectionObject($this->getContext())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        $info = $this->getInfo();

        return $info->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        $info = $this->getInfo();

        return $info->getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion(): string
    {
        $info = $this->getInfo();

        return $info->getVersion();
    }
}
