<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Linux\Native;

use Bic\Collection\Set;
use Bic\Collection\SetInterface;
use Bic\System\Linux\LinuxDriverInterface;
use Bic\System\Linux\Native\Processor\LinuxFeature;
use Bic\System\Processor\Architecture;
use Bic\System\Processor\Feature;
use Bic\System\Processor\FeatureInterface;

/**
 * @template-implements LinuxDriverInterface<LinuxProcessor>
 */
final class LinuxDriver implements LinuxDriverInterface
{
    /**
     * @var SetInterface<LinuxProcessor>|null
     */
    private SetInterface|null $cpu = null;

    /**
     * {@inheritDoc}
     */
    public function isAvailable(): bool
    {
        return \PHP_OS_FAMILY === 'Linux';
    }

    /**
     * {@inheritDoc}
     */
    public function getProcessors(): SetInterface
    {
        return $this->cpu ??= Set::new($this->read());
    }

    /**
     * @return iterable<LinuxProcessor>
     */
    private function read(): iterable
    {
        $architecture = $this->getArchitecture();

        foreach (Reader::read() as $entry) {
            yield new LinuxProcessor(
                architecture: $architecture,
                features: $this->getFeatures($entry['flags']),
                core: (int)$entry['core_id'],
                rate: (float)$entry['cpu_mhz'],
                vendor: $entry['vendor_id'],
                brand: $entry['model_name'],
                family: (int)$entry['cpu_family'],
            );
        }
    }

    /**
     * @return Architecture
     */
    private function getArchitecture(): Architecture
    {
        $uname = \strtolower(\php_uname('m'));

        return match (true) {
            \in_array($uname, ['amd64', 'x64', 'x86_64'], true) => Architecture::AMD64,
            \in_array($uname, ['x86', 'i386', 'i686'], true) => Architecture::X86,
            \str_starts_with($uname, 'arm64'),
            \str_starts_with($uname, 'aarch64'),
            \str_starts_with($uname, 'armv8') => Architecture::ARM64,
            $uname === 'arm' => Architecture::ARM,
            \str_starts_with($uname, 'mips') => Architecture::MIPS,
            \str_starts_with($uname, 'ppc') => Architecture::PPC,
            default => Architecture::UNKNOWN,
        };
    }

    /**
     * @param string $features
     * @return iterable<FeatureInterface>
     */
    private function getFeatures(string $features): iterable
    {
        /** @psalm-var non-empty-string $feature */
        foreach (\explode(' ', $features) as $feature) {
            $known = LinuxFeature::from($feature);

            yield $known === null
                ? Feature::create(\strtoupper($feature))
                : $known->toFeature()
            ;
        }
    }
}
