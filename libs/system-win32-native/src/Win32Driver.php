<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Win32\Native;

use Bic\Collection\Set;
use Bic\Collection\SetInterface;
use Bic\System\Processor\Architecture;
use Bic\System\Processor\Feature;
use Bic\System\Processor\FeatureInterface;
use Bic\System\Win32\Native\Api\Kernel32;
use Bic\System\Win32\Native\Processor\Win32Feature;
use Bic\System\Win32\Win32DriverInterface;
use FFI\Env\Runtime;

/**
 * @template-implements Win32DriverInterface<Win32Processor>
 */
final class Win32Driver implements Win32DriverInterface
{
    /**
     * @var SetInterface<Win32Processor>|null
     */
    private ?SetInterface $processor = null;

    /**
     * {@inheritDoc}
     */
    public function isAvailable(): bool
    {
        return \PHP_OS_FAMILY === 'Windows' && Runtime::isAvailable();
    }

    /**
     * {@inheritDoc}
     */
    public function getProcessors(): SetInterface
    {
        /**
         * @psalm-suppress UndefinedPropertyFetch
         * @psalm-suppress PossiblyNullArgument
         */
        return $this->processor ??= Set::fromIterable(function () {
            $kernel32 = new Kernel32();

            $info = $kernel32->new('SystemInfo');
            $kernel32->GetSystemInfo(\FFI::addr($info));

            $processor = new Win32Processor(
                architecture: $this->convertArchitecture($info->wProcessorArchitecture),
                features: $this->convertFeatures($kernel32),
            );

            for ($i = 0; $i < $info->dwNumberOfProcessors; ++$i) {
                yield clone $processor;
            }
        });
    }

    /**
     * @param Kernel32 $kernel32
     * @return iterable<FeatureInterface>
     */
    private function convertFeatures(Kernel32 $kernel32): iterable
    {
        $fpu = true;

        /** @var Win32Feature $case */
        foreach (Win32Feature::cases() as $case) {
            if ($kernel32->IsProcessorFeaturePresent($case->value)) {
                if ($case === Win32Feature::PF_FLOATING_POINT_EMULATED) {
                    $fpu = false;
                }

                yield $case->toFeature();
            }
        }

        if ($fpu) {
            yield Feature::FPU;
        }
    }

    /**
     * @param int $architecture
     * @return Architecture
     */
    private function convertArchitecture(int $architecture): Architecture
    {
        return match ($architecture) {
            // PROCESSOR_ARCHITECTURE_INTEL
            0 => Architecture::X86,
            // PROCESSOR_ARCHITECTURE_MIPS
            1 => Architecture::MIPS,
            // PROCESSOR_ARCHITECTURE_PPC
            3 => Architecture::PPC,
            // PROCESSOR_ARCHITECTURE_ARM
            5 => Architecture::ARM,
            // PROCESSOR_ARCHITECTURE_AMD64
            9 => Architecture::AMD64,
            // PROCESSOR_ARCHITECTURE_ARM64
            12 => Architecture::ARM64,
            // Other
            default => Architecture::UNKNOWN,
        };
    }
}
