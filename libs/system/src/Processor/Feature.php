<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Processor;

enum Feature implements FeatureInterface
{
    /**
     * Onboard FPU.
     *
     * @link https://en.wikipedia.org/wiki/Floating-point_unit
     */
    case FPU;

    /**
     * Multimedia Extensions.
     *
     * @link https://en.wikipedia.org/wiki/MMX_(instruction_set)
     */
    case MMX;

    /**
     * AMD 3DNow.
     *
     * @link https://en.wikipedia.org/wiki/3DNow!
     */
    case F_3DNOW;

    /**
     * Physical Address Extensions.
     *
     * @link https://en.wikipedia.org/wiki/Physical_Address_Extension
     */
    case PAE;

    /**
     * Execute Disable.
     *
     * @link https://www.intel.com/content/www/us/en/support/articles/000005771/processors.html
     */
    case NX;

    /**
     * CMPXCHG16B instruction
     *
     * https://en.wikipedia.org/wiki/Compare-and-swap
     */
    case CX16;

    /**
     * XSAVE/XRSTOR/XSETBV/XGETBV instructions.
     *
     * @link https://www.intel.com/content/www/us/en/develop/documentation/cpp-compiler-developer-guide-and-reference/top/compiler-reference/intrinsics/intrinsics-for-managing-ext-proc-states-and-regs/intrinsics-to-save-and-restore-ext-proc-states/xsave-xsavec-xsaves.html
     */
    case XSAVE;

    /**
     * RDFSBASE, WRFSBASE, RDGSBASE, WRGSBASE instructions.
     *
     * @link https://www.felixcloutier.com/x86/rdfsbase:rdgsbase
     */
    case FSGSBASE;

    /**
     * RDRAND instruction.
     *
     * @link https://en.wikipedia.org/wiki/RDRAND
     */
    case RDRAND;

    /**
     * RDTSCP instruction.
     *
     * @link https://docs.microsoft.com/en-us/cpp/intrinsics/rdtscp?view=msvc-170
     */
    case RDTSCP;

    /**
     * RDPID instruction.
     *
     * @link https://www.felixcloutier.com/x86/rdpid
     */
    case RDPID;

    /**
     * MONITOR/MWAIT support.
     *
     * @link https://www.felixcloutier.com/x86/monitor
     */
    case MONITOR;
    case SSE;
    case SSE2;
    case SSE3;
    case SSSE3;
    case SSE4_1;
    case SSE4_2;
    case AVX;
    case AVX2;
    case AVX512F;

    /**
     * @param non-empty-string $name
     * @return FeatureInterface
     */
    public static function create(string $name): FeatureInterface
    {
        /** @var array<non-empty-string, FeatureInterface> $features */
        static $features = [];

        return $features[$name] ??= new CustomFeature($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return match ($this) {
            Feature::F_3DNOW => '3DNow!',
            /** @psalm-suppress UndefinedThisPropertyFetch */
            default => $this->name,
        };
    }
}
