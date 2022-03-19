<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Win32\Native\Processor;

use Bic\System\Processor\Feature;
use Bic\System\Processor\FeatureInterface;

enum Win32Feature: int
{
    case PF_FLOATING_POINT_PRECISION_ERRATA = 0;
    /**
     * In case of {@see PF_FLOATING_POINT_EMULATED} not available then in
     * this case the {@see Feature::FPU} flag should be added added.
     */
    case PF_FLOATING_POINT_EMULATED = 1;
    case PF_COMPARE_EXCHANGE_DOUBLE = 2;
    /**
     * {@see Feature::MMX}
     */
    case PF_MMX_INSTRUCTIONS_AVAILABLE = 3;
    case PF_PPC_MOVEMEM_64BIT_OK = 4;
    case PF_ALPHA_BYTE_INSTRUCTIONS = 5;
    /**
     * {@see Feature::SSE}
     */
    case PF_XMMI_INSTRUCTIONS_AVAILABLE = 6;
    /**
     * {@see Feature::F_3DNOW}
     */
    case PF_3DNOW_INSTRUCTIONS_AVAILABLE = 7;
    case PF_RDTSC_INSTRUCTION_AVAILABLE = 8;
    /**
     * {@see Feature::PAE}
     */
    case PF_PAE_ENABLED = 9;
    /**
     * {@see Feature::SSE2}
     */
    case PF_XMMI64_INSTRUCTIONS_AVAILABLE = 10;
    case PF_SSE_DAZ_MODE_AVAILABLE = 11;
    /**
     * {@see Feature::NX}
     */
    case PF_NX_ENABLED = 12;
    /**
     * {@see Feature::SSE3}
     */
    case PF_SSE3_INSTRUCTIONS_AVAILABLE = 13;
    /**
     * {@see Feature::CX16}
     */
    case PF_COMPARE_EXCHANGE128 = 14;
    case PF_COMPARE64_EXCHANGE128 = 15;
    case PF_CHANNELS_ENABLED = 16;
    /**
     * {@see Feature::XSAVE}
     */
    case PF_XSAVE_ENABLED = 17;
    case PF_ARM_VFP_32_REGISTERS_AVAILABLE = 18;
    case PF_ARM_NEON_INSTRUCTIONS_AVAILABLE = 19;
    case PF_SECOND_LEVEL_ADDRESS_TRANSLATION = 20;
    case PF_VIRT_FIRMWARE_ENABLED = 21;
    /**
     * {@see Feature::FSGSBASE}
     */
    case PF_RDWRFSGSBASE_AVAILABLE = 22;
    case PF_FASTFAIL_AVAILABLE = 23;
    case PF_ARM_DIVIDE_INSTRUCTION_AVAILABLE = 24;
    case PF_ARM_64BIT_LOADSTORE_ATOMIC = 25;
    case PF_ARM_EXTERNAL_CACHE_AVAILABLE = 26;
    case PF_ARM_FMAC_INSTRUCTIONS_AVAILABLE = 27;
    /**
     * {@see Feature::RDRAND}
     */
    case PF_RDRAND_INSTRUCTION_AVAILABLE = 28;
    case PF_ARM_V8_INSTRUCTIONS_AVAILABLE = 29;
    case PF_ARM_V8_CRYPTO_INSTRUCTIONS_AVAILABLE = 30;
    case PF_ARM_V8_CRC32_INSTRUCTIONS_AVAILABLE = 31;
    /**
     * {@see Feature::RDTSCP}
     */
    case PF_RDTSCP_INSTRUCTION_AVAILABLE = 32;
    /**
     * {@see Feature::RDPID}
     */
    case PF_RDPID_INSTRUCTION_AVAILABLE = 33;
    case PF_ARM_V81_ATOMIC_INSTRUCTIONS_AVAILABLE = 34;
    /**
     * {@see Feature::MONITOR}
     */
    case PF_MONITORX_INSTRUCTION_AVAILABLE = 35;
    /**
     * {@see Feature::SSSE3}
     */
    case PF_SSSE3_INSTRUCTIONS_AVAILABLE = 36;
    /**
     * {@see Feature::SSE4_1}
     */
    case PF_SSE4_1_INSTRUCTIONS_AVAILABLE = 37;
    /**
     * {@see Feature::SSE4_2}
     */
    case PF_SSE4_2_INSTRUCTIONS_AVAILABLE = 38;
    /**
     * {@see Feature::AVX}
     */
    case PF_AVX_INSTRUCTIONS_AVAILABLE = 39;
    /**
     * {@see Feature::AVX2}
     */
    case PF_AVX2_INSTRUCTIONS_AVAILABLE = 40;
    /**
     * {@see Feature::AVX512F}
     */
    case PF_AVX512F_INSTRUCTIONS_AVAILABLE = 41;
    case PF_ERMS_AVAILABLE = 42;
    case PF_ARM_V82_DP_INSTRUCTIONS_AVAILABLE = 43;
    case PF_ARM_V83_JSCVT_INSTRUCTIONS_AVAILABLE = 44;

    /**
     * @return FeatureInterface
     */
    public function toFeature(): FeatureInterface
    {
        return match ($this) {
            Win32Feature::PF_MMX_INSTRUCTIONS_AVAILABLE => Feature::MMX,
            Win32Feature::PF_3DNOW_INSTRUCTIONS_AVAILABLE => Feature::F_3DNOW,
            Win32Feature::PF_PAE_ENABLED => Feature::PAE,
            Win32Feature::PF_NX_ENABLED => Feature::NX,
            Win32Feature::PF_COMPARE_EXCHANGE128 => Feature::CX16,
            Win32Feature::PF_XSAVE_ENABLED => Feature::XSAVE,
            Win32Feature::PF_RDWRFSGSBASE_AVAILABLE => Feature::FSGSBASE,
            Win32Feature::PF_RDRAND_INSTRUCTION_AVAILABLE => Feature::RDRAND,
            Win32Feature::PF_RDTSCP_INSTRUCTION_AVAILABLE => Feature::RDTSCP,
            Win32Feature::PF_RDPID_INSTRUCTION_AVAILABLE => Feature::RDPID,
            Win32Feature::PF_MONITORX_INSTRUCTION_AVAILABLE => Feature::MONITOR,
            Win32Feature::PF_XMMI_INSTRUCTIONS_AVAILABLE => Feature::SSE,
            Win32Feature::PF_XMMI64_INSTRUCTIONS_AVAILABLE => Feature::SSE2,
            Win32Feature::PF_SSE3_INSTRUCTIONS_AVAILABLE => Feature::SSE3,
            Win32Feature::PF_SSSE3_INSTRUCTIONS_AVAILABLE => Feature::SSSE3,
            Win32Feature::PF_SSE4_1_INSTRUCTIONS_AVAILABLE => Feature::SSE4_1,
            Win32Feature::PF_SSE4_2_INSTRUCTIONS_AVAILABLE => Feature::SSE4_2,
            Win32Feature::PF_AVX_INSTRUCTIONS_AVAILABLE => Feature::AVX,
            Win32Feature::PF_AVX2_INSTRUCTIONS_AVAILABLE => Feature::AVX2,
            Win32Feature::PF_AVX512F_INSTRUCTIONS_AVAILABLE => Feature::AVX512F,
            default => Feature::create($this->name),
        };
    }
}
