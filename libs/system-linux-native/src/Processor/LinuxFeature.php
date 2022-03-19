<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Linux\Native\Processor;

use Bic\System\Processor\Feature;
use Bic\System\Processor\FeatureInterface;

/**
 * @link https://github.com/torvalds/linux/blob/master/arch/x86/include/asm/cpufeatures.h
 */
enum LinuxFeature: string
{
    /** Onboard FPU  */
    case FEATURE_FPU = 'fpu';
    /** Virtual Mode Extensions  */
    case FEATURE_VME = 'vme';
    /** Debugging Extensions  */
    case FEATURE_DE = 'de';
    /** Page Size Extensions  */
    case FEATURE_PSE = 'pse';
    /** Time Stamp Counter  */
    case FEATURE_TSC = 'tsc';
    /** Model-Specific Registers  */
    case FEATURE_MSR = 'msr';
    /** Physical Address Extensions  */
    case FEATURE_PAE = 'pae';
    /** Machine Check Exception  */
    case FEATURE_MCE = 'mce';
    /** CMPXCHG8 instruction  */
    case FEATURE_CX8 = 'cx8';
    /** Onboard APIC  */
    case FEATURE_APIC = 'apic';
    /** SYSENTER/SYSEXIT  */
    case FEATURE_SEP = 'sep';
    /** Memory Type Range Registers  */
    case FEATURE_MTRR = 'mtrr';
    /** Page Global Enable  */
    case FEATURE_PGE = 'pge';
    /** Machine Check Architecture  */
    case FEATURE_MCA = 'mca';
    /** CMOV instructions (plus FCMOVcc, FCOMI with FPU)  */
    case FEATURE_CMOV = 'cmov';
    /** Page Attribute Table  */
    case FEATURE_PAT = 'pat';
    /** 36-bit PSEs  */
    case FEATURE_PSE36 = 'pse36';
    /** Processor serial number  */
    case FEATURE_PN = 'pn';
    /** CLFLUSH instruction  */
    case FEATURE_CLFLUSH = 'clflush';
    /** Debug Store  */
    case FEATURE_DS = 'dts';
    /** ACPI via MSR  */
    case FEATURE_ACPI = 'acpi';
    /** Multimedia Extensions  */
    case FEATURE_MMX = 'mmx';
    /** FXSAVE/FXRSTOR, CR4.OSFXSR  */
    case FEATURE_FXSR = 'fxsr';
    /** */
    case FEATURE_SSE = 'sse';
    /** */
    case FEATURE_SSE2 = 'sse2';
    /** CPU self snoop  */
    case FEATURE_SELFSNOOP = 'ss';
    /** Hyper-Threading  */
    case FEATURE_HT = 'ht';
    /** Automatic clock control  */
    case FEATURE_ACC = 'tm';
    /** IA-64 processor  */
    case FEATURE_IA64 = 'ia64';
    /** Pending Break Enable  */
    case FEATURE_PBE = 'pbe';
    /** SYSCALL/SYSRET  */
    case FEATURE_SYSCALL = 'syscall';
    /** MP Capable  */
    case FEATURE_MP = 'mp';
    /** Execute Disable  */
    case FEATURE_NX = 'nx';
    /** AMD MMX extensions  */
    case FEATURE_MMXEXT = 'mmxext';
    /** FXSAVE/FXRSTOR optimizations  */
    case FEATURE_FXSR_OPT = 'fxsr_opt';
    /** GB pages  */
    case FEATURE_PDPE1GB = 'pdpe1gb';
    /** RDTSCP  */
    case FEATURE_RDTSCP = 'rdtscp';
    /** Long Mode (x86-64, 64-bit support)  */
    case FEATURE_LM = 'lm';
    /** AMD 3DNow extensions  */
    case FEATURE_3DNOWEXT = '3dnowext';
    /** 3DNow  */
    case FEATURE_3DNOW = '3dnow';
    /** CPU in recovery mode  */
    case FEATURE_RECOVERY = 'recovery';
    /** Longrun power control  */
    case FEATURE_LONGRUN = 'longrun';
    /** LongRun table interface  */
    case FEATURE_LRTI = 'lrti';
    /** Cyrix MMX extensions  */
    case FEATURE_CXMMX = 'cxmmx';
    /** AMD K6 nonstandard MTRRs  */
    case FEATURE_K6_MTRR = 'k6_mtrr';
    /** Cyrix ARRs (= MTRRs)  */
    case FEATURE_CYRIX_ARR = 'cyrix_arr';
    /** Centaur MCRs (= MTRRs)  */
    case FEATURE_CENTAUR_MCR = 'centaur_mcr';
    /** Opteron, Athlon64  */
    case FEATURE_K8 = 'k8';
    /** P3  */
    case FEATURE_P3 = 'p3';
    /** P4  */
    case FEATURE_P4 = 'p4';
    /** TSC ticks at a constant rate  */
    case FEATURE_CONSTANT_TSC = 'constant_tsc';
    /** SMP kernel running on UP  */
    case FEATURE_UP = 'up';
    /** Always running timer (ART)  */
    case FEATURE_ART = 'art';
    /** Intel Architectural PerfMon  */
    case FEATURE_ARCH_PERFMON = 'arch_perfmon';
    /** Precise-Event Based Sampling  */
    case FEATURE_PEBS = 'pebs';
    /** Branch Trace Store  */
    case FEATURE_BTS = 'bts';
    /** syscall in IA32 userspace  */
    case FEATURE_SYSCALL32 = 'syscall32';
    /** sysenter in IA32 userspace  */
    case FEATURE_SYSENTER32 = 'sysenter32';
    /** REP microcode works well  */
    case FEATURE_REP_GOOD = 'rep_good';
    /** LFENCE synchronizes RDTSC  */
    case FEATURE_LFENCE_RDTSC = 'lfence_rdtsc';
    /** AMD Accumulated Power Mechanism  */
    case FEATURE_ACC_POWER = 'acc_power';
    /** The NOPL (0F 1F) instructions  */
    case FEATURE_NOPL = 'nopl';
    /** Always-present feature  */
    case FEATURE_ALWAYS = 'always';
    /** CPU topology enum extensions  */
    case FEATURE_XTOPOLOGY = 'xtopology';
    /** TSC is known to be reliable  */
    case FEATURE_TSC_RELIABLE = 'tsc_reliable';
    /** TSC does not stop in C states  */
    case FEATURE_NONSTOP_TSC = 'nonstop_tsc';
    /** CPU has CPUID instruction itself  */
    case FEATURE_CPUID = 'cpuid';
    /** Extended APICID (8 bits)  */
    case FEATURE_EXTD_APICID = 'extd_apicid';
    /** AMD multi-node processor  */
    case FEATURE_AMD_DCM = 'amd_dcm';
    /** P-State hardware coordination feedback capability (APERF/MPERF MSRs)  */
    case FEATURE_APERFMPERF = 'aperfmperf';
    /** AMD/Hygon RAPL interface  */
    case FEATURE_RAPL = 'rapl';
    /** TSC doesn't stop in S3 state  */
    case FEATURE_NONSTOP_TSC_S3 = 'nonstop_tsc_s3';
    /** TSC has known frequency  */
    case FEATURE_TSC_KNOWN_FREQ = 'tsc_known_freq';
    /** SSE-3  */
    case FEATURE_PNI = 'pni';
    /** PCLMULQDQ instruction  */
    case FEATURE_PCLMULQDQ = 'pclmulqdq';
    /** 64-bit Debug Store  */
    case FEATURE_DTES64 = 'dtes64';
    /** MONITOR/MWAIT support  */
    case FEATURE_MONITOR = 'monitor';
    /** CPL-qualified (filtered) Debug Store  */
    case FEATURE_DSCPL = 'ds_cpl';
    /** Hardware virtualization  */
    case FEATURE_VMX = 'vmx';
    /** Safer Mode eXtensions  */
    case FEATURE_SMX = 'smx';
    /** Enhanced SpeedStep  */
    case FEATURE_EST = 'est';
    /** Thermal Monitor 2  */
    case FEATURE_TM2 = 'tm2';
    /** Supplemental SSE-3  */
    case FEATURE_SSSE3 = 'ssse3';
    /** Context ID  */
    case FEATURE_CID = 'cid';
    /** Silicon Debug  */
    case FEATURE_SDBG = 'sdbg';
    /** Fused multiply-add  */
    case FEATURE_FMA = 'fma';
    /** CMPXCHG16B instruction  */
    case FEATURE_CX16 = 'cx16';
    /** Send Task Priority Messages  */
    case FEATURE_XTPR = 'xtpr';
    /** Perf/Debug Capabilities MSR  */
    case FEATURE_PDCM = 'pdcm';
    /** Process Context Identifiers  */
    case FEATURE_PCID = 'pcid';
    /** Direct Cache Access  */
    case FEATURE_DCA = 'dca';
    /** SSE-4.1  */
    case FEATURE_SSE4_1 = 'sse4_1';
    /** SSE-4.2  */
    case FEATURE_SSE4_2 = 'sse4_2';
    /** X2APIC  */
    case FEATURE_X2APIC = 'x2apic';
    /** MOVBE instruction  */
    case FEATURE_MOVBE = 'movbe';
    /** POPCNT instruction  */
    case FEATURE_POPCNT = 'popcnt';
    /** TSC deadline timer  */
    case FEATURE_TSC_DEADLINE_TIMER = 'tsc_deadline_timer';
    /** AES instructions  */
    case FEATURE_AES = 'aes';
    /** XSAVE/XRSTOR/XSETBV/XGETBV instructions  */
    case FEATURE_XSAVE = 'xsave';
    /** XSAVE instruction enabled in the OS  */
    case FEATURE_OSXSAVE = 'osxsave';
    /** Advanced Vector Extensions  */
    case FEATURE_AVX = 'avx';
    /** 16-bit FP conversions  */
    case FEATURE_F16C = 'f16c';
    /** RDRAND instruction  */
    case FEATURE_RDRAND = 'rdrand';
    /** Running on a hypervisor  */
    case FEATURE_HYPERVISOR = 'hypervisor';
    /** RNG present (xstore)  */
    case FEATURE_XSTORE = 'xstore';
    /** RNG enabled  */
    case FEATURE_XSTORE_EN = 'xstore_en';
    /** on-CPU crypto (xcrypt)  */
    case FEATURE_XCRYPT = 'xcrypt';
    /** on-CPU crypto enabled  */
    case FEATURE_XCRYPT_EN = 'xcrypt_en';
    /** Advanced Cryptography Engine v2  */
    case FEATURE_ACE2 = 'ace2';
    /** ACE v2 enabled  */
    case FEATURE_ACE2_EN = 'ace2_en';
    /** PadLock Hash Engine  */
    case FEATURE_PHE = 'phe';
    /** PHE enabled  */
    case FEATURE_PHE_EN = 'phe_en';
    /** PadLock Montgomery Multiplier  */
    case FEATURE_PMM = 'pmm';
    /** PMM enabled  */
    case FEATURE_PMM_EN = 'pmm_en';
    /** LAHF/SAHF in long mode  */
    case FEATURE_LAHF_LM = 'lahf_lm';
    /** If yes HyperThreading not valid  */
    case FEATURE_CMP_LEGACY = 'cmp_legacy';
    /** Secure Virtual Machine  */
    case FEATURE_SVM = 'svm';
    /** Extended APIC space  */
    case FEATURE_EXTAPIC = 'extapic';
    /** CR8 in 32-bit mode  */
    case FEATURE_CR8_LEGACY = 'cr8_legacy';
    /** Advanced bit manipulation  */
    case FEATURE_ABM = 'abm';
    /** SSE-4A  */
    case FEATURE_SSE4A = 'sse4a';
    /** Misaligned SSE mode  */
    case FEATURE_MISALIGNSSE = 'misalignsse';
    /** 3DNow prefetch instructions  */
    case FEATURE_3DNOWPREFETCH = '3dnowprefetch';
    /** OS Visible Workaround  */
    case FEATURE_OSVW = 'osvw';
    /** Instruction Based Sampling  */
    case FEATURE_IBS = 'ibs';
    /** extended AVX instructions  */
    case FEATURE_XOP = 'xop';
    /** SKINIT/STGI instructions  */
    case FEATURE_SKINIT = 'skinit';
    /** Watchdog timer  */
    case FEATURE_WDT = 'wdt';
    /** Light Weight Profiling  */
    case FEATURE_LWP = 'lwp';
    /** 4 operands MAC instructions  */
    case FEATURE_FMA4 = 'fma4';
    /** Translation Cache Extension  */
    case FEATURE_TCE = 'tce';
    /** NodeId MSR  */
    case FEATURE_NODEID_MSR = 'nodeid_msr';
    /** Trailing Bit Manipulations  */
    case FEATURE_TBM = 'tbm';
    /** Topology extensions CPUID leafs  */
    case FEATURE_TOPOEXT = 'topoext';
    /** Core performance counter extensions  */
    case FEATURE_PERFCTR_CORE = 'perfctr_core';
    /** NB performance counter extensions  */
    case FEATURE_PERFCTR_NB = 'perfctr_nb';
    /** Data breakpoint extension  */
    case FEATURE_BPEXT = 'bpext';
    /** Performance time-stamp counter  */
    case FEATURE_PTSC = 'ptsc';
    /** Last Level Cache performance counter extensions  */
    case FEATURE_PERFCTR_LLC = 'perfctr_llc';
    /** MWAIT extension (MONITORX/MWAITX instructions)  */
    case FEATURE_MWAITX = 'mwaitx';
    /** Ring 3 MONITOR/MWAIT instructions  */
    case FEATURE_RING3MWAIT = 'ring3mwait';
    /** Intel CPUID faulting  */
    case FEATURE_CPUID_FAULT = 'cpuid_fault';
    /** AMD Core Performance Boost  */
    case FEATURE_CPB = 'cpb';
    /** IA32_ENERGY_PERF_BIAS support  */
    case FEATURE_EPB = 'epb';
    /** Cache Allocation Technology L3  */
    case FEATURE_CAT_L3 = 'cat_l3';
    /** Cache Allocation Technology L2  */
    case FEATURE_CAT_L2 = 'cat_l2';
    /** Code and Data Prioritization L3  */
    case FEATURE_CDP_L3 = 'cdp_l3';
    /** Effectively INVPCID && CR4.PCIDE=1  */
    case FEATURE_INVPCID_SINGLE = 'invpcid_single';
    /** AMD HW-PState  */
    case FEATURE_HW_PSTATE = 'hw_pstate';
    /** AMD ProcFeedbackInterface  */
    case FEATURE_PROC_FEEDBACK = 'proc_feedback';
    /** Kernel Page Table Isolation enabled  */
    case FEATURE_PTI = 'pti';
    /** Generic Retpoline mitigation for Spectre variant 2  */
    case FEATURE_RETPOLINE = 'retpoline';
    /** AMD Retpoline mitigation for Spectre variant 2  */
    case FEATURE_RETPOLINE_AMD = 'retpoline_amd';
    /** Intel Processor Inventory Number  */
    case FEATURE_INTEL_PPIN = 'intel_ppin';
    /** Code and Data Prioritization L2  */
    case FEATURE_CDP_L2 = 'cdp_l2';
    /** MSR SPEC_CTRL is implemented  */
    case FEATURE_MSR_SPEC_CTRL = 'msr_spec_ctrl';
    /** Speculative Store Bypass Disable  */
    case FEATURE_SSBD = 'ssbd';
    /** Memory Bandwidth Allocation  */
    case FEATURE_MBA = 'mba';
    /** Fill RSB on context switches  */
    case FEATURE_RSB_CTXSW = 'rsb_ctxsw';
    /** Indirect Branch Prediction Barrier enabled  */
    case FEATURE_USE_IBPB = 'use_ibpb';
    /** Use IBRS during runtime firmware calls  */
    case FEATURE_USE_IBRS_FW = 'use_ibrs_fw';
    /** Disable Speculative Store Bypass.  */
    case FEATURE_SPEC_STORE_BYPASS_DISABLE = 'spec_store_bypass_disable';
    /** AMD SSBD implementation via LS_CFG MSR  */
    case FEATURE_LS_CFG_SSBD = 'ls_cfg_ssbd';
    /** Indirect Branch Restricted Speculation  */
    case FEATURE_IBRS = 'ibrs';
    /** Indirect Branch Prediction Barrier  */
    case FEATURE_IBPB = 'ibpb';
    /** Single Thread Indirect Branch Predictors  */
    case FEATURE_STIBP = 'stibp';
    /** CPU is AMD family 0x17 or above (Zen)  */
    case FEATURE_ZEN = 'zen';
    /** L1TF workaround PTE inversion  */
    case FEATURE_L1TF_PTEINV = 'l1tf_pteinv';
    /** Enhanced IBRS  */
    case FEATURE_IBRS_ENHANCED = 'ibrs_enhanced';
    /** MSR IA32_FEAT_CTL configured  */
    case FEATURE_MSR_IA32_FEAT_CTL = 'msr_ia32_feat_ctl';
    /** Intel TPR Shadow  */
    case FEATURE_TPR_SHADOW = 'tpr_shadow';
    /** Intel Virtual NMI  */
    case FEATURE_VNMI = 'vnmi';
    /** Intel FlexPriority  */
    case FEATURE_FLEXPRIORITY = 'flexpriority';
    /** Intel Extended Page Table  */
    case FEATURE_EPT = 'ept';
    /** Intel Virtual Processor ID  */
    case FEATURE_VPID = 'vpid';
    /** Prefer VMMCALL to VMCALL  */
    case FEATURE_VMMCALL = 'vmmcall';
    /** Xen paravirtual guest  */
    case FEATURE_XENPV = 'xenpv';
    /** Intel Extended Page Table access-dirty bit  */
    case FEATURE_EPT_AD = 'ept_ad';
    /** Hypervisor supports the VMCALL instruction  */
    case FEATURE_VMCALL = 'vmcall';
    /** VMware prefers VMMCALL hypercall instruction  */
    case FEATURE_VMW_VMMCALL = 'vmw_vmmcall';
    /** PV unlock function  */
    case FEATURE_PVUNLOCK = 'pvunlock';
    /** PV vcpu_is_preempted function  */
    case FEATURE_VCPUPREEMPT = 'vcpupreempt';
    /** RDFSBASE, WRFSBASE, RDGSBASE, WRGSBASE instructions */
    case FEATURE_FSGSBASE = 'fsgsbase';
    /** TSC adjustment MSR 0x3B  */
    case FEATURE_TSC_ADJUST = 'tsc_adjust';
    /** Software Guard Extensions  */
    case FEATURE_SGX = 'sgx';
    /** 1st group bit manipulation extensions  */
    case FEATURE_BMI1 = 'bmi1';
    /** Hardware Lock Elision  */
    case FEATURE_HLE = 'hle';
    /** AVX2 instructions  */
    case FEATURE_AVX2 = 'avx2';
    /** FPU data pointer updated only on x87 exceptions  */
    case FEATURE_FDP_EXCPTN_ONLY = 'fdp_excptn_only';
    /** Supervisor Mode Execution Protection  */
    case FEATURE_SMEP = 'smep';
    /** 2nd group bit manipulation extensions  */
    case FEATURE_BMI2 = 'bmi2';
    /** Enhanced REP MOVSB/STOSB instructions  */
    case FEATURE_ERMS = 'erms';
    /** Invalidate Processor Context ID  */
    case FEATURE_INVPCID = 'invpcid';
    /** Restricted Transactional Memory  */
    case FEATURE_RTM = 'rtm';
    /** Cache QoS Monitoring  */
    case FEATURE_CQM = 'cqm';
    /** Zero out FPU CS and FPU DS  */
    case FEATURE_ZERO_FCS_FDS = 'zero_fcs_fds';
    /** Memory Protection Extension  */
    case FEATURE_MPX = 'mpx';
    /** Resource Director Technology Allocation  */
    case FEATURE_RDT_A = 'rdt_a';
    /** AVX-512 Foundation  */
    case FEATURE_AVX512F = 'avx512f';
    /** AVX-512 DQ (Double/Quad granular) Instructions  */
    case FEATURE_AVX512DQ = 'avx512dq';
    /** RDSEED instruction  */
    case FEATURE_RDSEED = 'rdseed';
    /** ADCX and ADOX instructions  */
    case FEATURE_ADX = 'adx';
    /** Supervisor Mode Access Prevention  */
    case FEATURE_SMAP = 'smap';
    /** AVX-512 Integer Fused Multiply-Add instructions  */
    case FEATURE_AVX512IFMA = 'avx512ifma';
    /** CLFLUSHOPT instruction  */
    case FEATURE_CLFLUSHOPT = 'clflushopt';
    /** CLWB instruction  */
    case FEATURE_CLWB = 'clwb';
    /** Intel Processor Trace  */
    case FEATURE_INTEL_PT = 'intel_pt';
    /** AVX-512 Prefetch  */
    case FEATURE_AVX512PF = 'avx512pf';
    /** AVX-512 Exponential and Reciprocal  */
    case FEATURE_AVX512ER = 'avx512er';
    /** AVX-512 Conflict Detection  */
    case FEATURE_AVX512CD = 'avx512cd';
    /** SHA1/SHA256 Instruction Extensions  */
    case FEATURE_SHA_NI = 'sha_ni';
    /** AVX-512 BW (Byte/Word granular) Instructions  */
    case FEATURE_AVX512BW = 'avx512bw';
    /** AVX-512 VL (128/256 Vector Length) Extensions  */
    case FEATURE_AVX512VL = 'avx512vl';
    /** XSAVEOPT instruction  */
    case FEATURE_XSAVEOPT = 'xsaveopt';
    /** XSAVEC instruction  */
    case FEATURE_XSAVEC = 'xsavec';
    /** XGETBV with ECX = 1 instruction  */
    case FEATURE_XGETBV1 = 'xgetbv1';
    /** XSAVES/XRSTORS instructions  */
    case FEATURE_XSAVES = 'xsaves';
    /** eXtended Feature Disabling  */
    case FEATURE_XFD = 'xfd';
    /** LLC QoS if 1  */
    case FEATURE_CQM_LLC = 'cqm_llc';
    /** LLC occupancy monitoring  */
    case FEATURE_CQM_OCCUP_LLC = 'cqm_occup_llc';
    /** LLC Total MBM monitoring  */
    case FEATURE_CQM_MBM_TOTAL = 'cqm_mbm_total';
    /** LLC Local MBM monitoring  */
    case FEATURE_CQM_MBM_LOCAL = 'cqm_mbm_local';
    /** LFENCE in user entry SWAPGS path  */
    case FEATURE_FENCE_SWAPGS_USER = 'fence_swapgs_user';
    /** LFENCE in kernel entry SWAPGS path  */
    case FEATURE_FENCE_SWAPGS_KERNEL = 'fence_swapgs_kernel';
    /** #AC for split lock  */
    case FEATURE_SPLIT_LOCK_DETECT = 'split_lock_detect';
    /** Per-thread Memory Bandwidth Allocation  */
    case FEATURE_PER_THREAD_MBA = 'per_thread_mba';
    /** Basic SGX  */
    case FEATURE_SGX1 = 'sgx1';
    /** SGX Enclave Dynamic Memory Management (EDMM)  */
    case FEATURE_SGX2 = 'sgx2';
    /** AVX VNNI instructions  */
    case FEATURE_AVX_VNNI = 'avx_vnni';
    /** AVX512 BFLOAT16 instructions  */
    case FEATURE_AVX512_BF16 = 'avx512_bf16';
    /** AMX bf16 Support  */
    case FEATURE_AMX_BF16 = 'amx_bf16';
    /** AMX tile Support  */
    case FEATURE_AMX_TILE = 'amx_tile';
    /** AMX int8 Support  */
    case FEATURE_AMX_INT8 = 'amx_int8';
    /** CLZERO instruction  */
    case FEATURE_CLZERO = 'clzero';
    /** Instructions Retired Count  */
    case FEATURE_IRPERF = 'irperf';
    /** Always save/restore FP error pointers  */
    case FEATURE_XSAVEERPTR = 'xsaveerptr';
    /** Read processor register at user level  */
    case FEATURE_RDPRU = 'rdpru';
    /** WBNOINVD instruction  */
    case FEATURE_WBNOINVD = 'wbnoinvd';
    /** Indirect Branch Prediction Barrier  */
    case FEATURE_AMD_IBPB = 'amd_ibpb';
    /** Indirect Branch Restricted Speculation  */
    case FEATURE_AMD_IBRS = 'amd_ibrs';
    /** Single Thread Indirect Branch Predictors  */
    case FEATURE_AMD_STIBP = 'amd_stibp';
    /** Single Thread Indirect Branch Predictors always-on preferred  */
    case FEATURE_AMD_STIBP_ALWAYS_ON = 'amd_stibp_always_on';
    /** Protected Processor Inventory Number  */
    case FEATURE_AMD_PPIN = 'amd_ppin';
    /** Speculative Store Bypass Disable  */
    case FEATURE_AMD_SSBD = 'amd_ssbd';
    /** Virtualized Speculative Store Bypass Disable  */
    case FEATURE_VIRT_SSBD = 'virt_ssbd';
    /** Speculative Store Bypass is fixed in hardware.  */
    case FEATURE_AMD_SSB_NO = 'amd_ssb_no';
    /** Collaborative Processor Performance Control  */
    case FEATURE_CPPC = 'cppc';
    /** Digital Thermal Sensor  */
    case FEATURE_DTHERM = 'dtherm';
    /** Intel Dynamic Acceleration  */
    case FEATURE_IDA = 'ida';
    /** Always Running APIC Timer  */
    case FEATURE_ARAT = 'arat';
    /** Intel Power Limit Notification  */
    case FEATURE_PLN = 'pln';
    /** Intel Package Thermal Status  */
    case FEATURE_PTS = 'pts';
    /** Intel Hardware P-states  */
    case FEATURE_HWP = 'hwp';
    /** HWP Notification  */
    case FEATURE_HWP_NOTIFY = 'hwp_notify';
    /** HWP Activity Window  */
    case FEATURE_HWP_ACT_WINDOW = 'hwp_act_window';
    /** HWP Energy Perf. Preference  */
    case FEATURE_HWP_EPP = 'hwp_epp';
    /** HWP Package Level Request  */
    case FEATURE_HWP_PKG_REQ = 'hwp_pkg_req';
    /** Nested Page Table support  */
    case FEATURE_NPT = 'npt';
    /** LBR Virtualization support  */
    case FEATURE_LBRV = 'lbrv';
    /** SVM locking MSR  */
    case FEATURE_SVML = 'svm_lock';
    /** SVM next_rip save  */
    case FEATURE_NRIPS = 'nrip_save';
    /** TSC scaling support  */
    case FEATURE_TSCRATEMSR = 'tsc_scale';
    /** VMCB clean bits support  */
    case FEATURE_VMCBCLEAN = 'vmcb_clean';
    /** flush-by-ASID support  */
    case FEATURE_FLUSHBYASID = 'flushbyasid';
    /** Decode Assists support  */
    case FEATURE_DECODEASSISTS = 'decodeassists';
    /** filtered pause intercept  */
    case FEATURE_PAUSEFILTER = 'pausefilter';
    /** pause filter threshold  */
    case FEATURE_PFTHRESHOLD = 'pfthreshold';
    /** Virtual Interrupt Controller  */
    case FEATURE_AVIC = 'avic';
    /** Virtual VMSAVE VMLOAD  */
    case FEATURE_V_VMSAVE_VMLOAD = 'v_vmsave_vmload';
    /** Virtual GIF  */
    case FEATURE_VGIF = 'vgif';
    /** Virtual SPEC_CTRL  */
    case FEATURE_V_SPEC_CTRL = 'v_spec_ctrl';
    /** SVME addr check  */
    case FEATURE_SVME_ADDR_CHK = 'svme_addr_chk';
    /** AVX512 Vector Bit Manipulation instructions */
    case FEATURE_AVX512VBMI = 'avx512vbmi';
    /** User Mode Instruction Protection  */
    case FEATURE_UMIP = 'umip';
    /** Protection Keys for Userspace  */
    case FEATURE_PKU = 'pku';
    /** OS Protection Keys Enable  */
    case FEATURE_OSPKE = 'ospke';
    /** UMONITOR/UMWAIT/TPAUSE Instructions  */
    case FEATURE_WAITPKG = 'waitpkg';
    /** Additional AVX512 Vector Bit Manipulation Instructions  */
    case FEATURE_AVX512_VBMI2 = 'avx512_vbmi2';
    /** Galois Field New Instructions  */
    case FEATURE_GFNI = 'gfni';
    /** Vector AES  */
    case FEATURE_VAES = 'vaes';
    /** Carry-Less Multiplication Double Quadword  */
    case FEATURE_VPCLMULQDQ = 'vpclmulqdq';
    /** Vector Neural Network Instructions  */
    case FEATURE_AVX512_VNNI = 'avx512_vnni';
    /** Support for VPOPCNT[B,W] and VPSHUF-BITQMB instructions  */
    case FEATURE_AVX512_BITALG = 'avx512_bitalg';
    /** Intel Total Memory Encryption  */
    case FEATURE_TME = 'tme';
    /** POPCNT for vectors of DW/QW  */
    case FEATURE_AVX512_VPOPCNTDQ = 'avx512_vpopcntdq';
    /** 5-level page tables  */
    case FEATURE_LA57 = 'la57';
    /** RDPID instruction  */
    case FEATURE_RDPID = 'rdpid';
    /** Bus Lock detect  */
    case FEATURE_BUS_LOCK_DETECT = 'bus_lock_detect';
    /** CLDEMOTE instruction  */
    case FEATURE_CLDEMOTE = 'cldemote';
    /** MOVDIRI instruction  */
    case FEATURE_MOVDIRI = 'movdiri';
    /** MOVDIR64B instruction  */
    case FEATURE_MOVDIR64B = 'movdir64b';
    /** ENQCMD and ENQCMDS instructions  */
    case FEATURE_ENQCMD = 'enqcmd';
    /** Software Guard Extensions Launch Control  */
    case FEATURE_SGX_LC = 'sgx_lc';
    /** MCA overflow recovery support  */
    case FEATURE_OVERFLOW_RECOV = 'overflow_recov';
    /** Uncorrectable error containment and recovery  */
    case FEATURE_SUCCOR = 'succor';
    /** Scalable MCA  */
    case FEATURE_SMCA = 'smca';
    /** AVX-512 Neural Network Instructions  */
    case FEATURE_AVX512_4VNNIW = 'avx512_4vnniw';
    /** AVX-512 Multiply Accumulation Single precision  */
    case FEATURE_AVX512_4FMAPS = 'avx512_4fmaps';
    /** Fast Short Rep Mov  */
    case FEATURE_FSRM = 'fsrm';
    /* AVX-512 Intersect for D/Q */
    case FEATURE_AVX512_VP2INTERSECT = 'avx512vp2intersect';
    /** SRBDS mitigation MSR available  */
    case FEATURE_SRBDS_CTRL = 'srbds_ctrl';
    /** VERW clears CPU buffers  */
    case FEATURE_MD_CLEAR = 'md_clear';
    /** RTM transaction always aborts  */
    case FEATURE_RTM_ALWAYS_ABORT = 'rtm_always_abort';
    /** TSX_FORCE_ABORT  */
    case FEATURE_TSX_FORCE_ABORT = 'tsx_force_abort';
    /** SERIALIZE instruction  */
    case FEATURE_SERIALIZE = 'serialize';
    /** This part has CPUs of more than one type  */
    case FEATURE_HYBRID_CPU = 'hybrid_cpu';
    /** TSX Suspend Load Address Tracking  */
    case FEATURE_TSXLDTRK = 'tsxldtrk';
    /** Intel PCONFIG  */
    case FEATURE_PCONFIG = 'pconfig';
    /** Intel ARCH LBR  */
    case FEATURE_ARCH_LBR = 'arch_lbr';
    /** AVX512 FP16  */
    case FEATURE_AVX512_FP16 = 'avx512_fp16';
    /** Speculation Control (IBRS + IBPB)  */
    case FEATURE_SPEC_CTRL = 'spec_ctrl';
    /** Single Thread Indirect Branch Predictors  */
    case FEATURE_INTEL_STIBP = 'intel_stibp';
    /** Flush L1D cache  */
    case FEATURE_FLUSH_L1D = 'flush_l1d';
    /** IA32_ARCH_CAPABILITIES MSR (Intel)  */
    case FEATURE_ARCH_CAPABILITIES = 'arch_capabilities';
    /** IA32_CORE_CAPABILITIES MSR  */
    case FEATURE_CORE_CAPABILITIES = 'core_capabilities';
    /** Speculative Store Bypass Disable  */
    case FEATURE_SPEC_CTRL_SSBD = 'spec_ctrl_ssbd';
    /** AMD Secure Memory Encryption  */
    case FEATURE_SME = 'sme';
    /** AMD Secure Encrypted Virtualization  */
    case FEATURE_SEV = 'sev';
    /** VM Page Flush MSR is supported  */
    case FEATURE_VM_PAGE_FLUSH = 'vm_page_flush';
    /** AMD Secure Encrypted Virtualization - Encrypted State  */
    case FEATURE_SEV_ES = 'sev_es';
    /** AMD hardware-enforced cache coherency  */
    case FEATURE_SME_COHERENT = 'sme_coherent';

    /**
     * @return FeatureInterface
     */
    public function toFeature(): FeatureInterface
    {
        return match ($this) {
            LinuxFeature::FEATURE_FPU => Feature::FPU,
            LinuxFeature::FEATURE_MMX => Feature::MMX,
            LinuxFeature::FEATURE_3DNOW => Feature::F_3DNOW,
            LinuxFeature::FEATURE_PAE => Feature::PAE,
            LinuxFeature::FEATURE_NX => Feature::NX,
            LinuxFeature::FEATURE_CX16 => Feature::CX16,
            LinuxFeature::FEATURE_XSAVE => Feature::XSAVE,
            LinuxFeature::FEATURE_FSGSBASE => Feature::FSGSBASE,
            LinuxFeature::FEATURE_RDRAND => Feature::RDRAND,
            LinuxFeature::FEATURE_RDTSCP => Feature::RDTSCP,
            LinuxFeature::FEATURE_RDPID => Feature::RDPID,
            LinuxFeature::FEATURE_MONITOR => Feature::MONITOR,
            LinuxFeature::FEATURE_SSE => Feature::SSE,
            LinuxFeature::FEATURE_SSE2 => Feature::SSE2,
            LinuxFeature::FEATURE_PNI => Feature::SSE3,
            LinuxFeature::FEATURE_SSSE3 => Feature::SSSE3,
            LinuxFeature::FEATURE_SSE4_1 => Feature::SSE4_1,
            LinuxFeature::FEATURE_SSE4_2 => Feature::SSE4_2,
            LinuxFeature::FEATURE_AVX => Feature::AVX,
            LinuxFeature::FEATURE_AVX2 => Feature::AVX2,
            LinuxFeature::FEATURE_AVX512F => Feature::AVX512F,
            default => Feature::create(\strtoupper($this->value)),
        };
    }
}
