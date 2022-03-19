<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\System\Linux\Native;

/**
 * @psalm-type CPUInfoArray = array {
 *  processor:          numeric-string,
 *  vendor_id:          string,
 *  cpu_family:         numeric-string,
 *  model:              numeric-string,
 *  model_name:         string,
 *  stepping:           numeric-string,
 *  microcode:          numeric-string,
 *  cpu_mhz:            numeric-string,
 *  cache_size:         string,
 *  physical_id:        numeric-string,
 *  siblings:           numeric-string,
 *  core_id:            numeric-string,
 *  cpu_cores:          numeric-string,
 *  apicid:             numeric-string,
 *  initial_apicid:     numeric-string,
 *  fpu:                "yes"|"no",
 *  fpu_exception:      "yes"|"no",
 *  cpuid_level:        numeric-string,
 *  wp:                 "yes"|"no",
 *  flags:              string,
 *  bugs:               string,
 *  bogomips:           numeric-string,
 *  tlb_size:           string,
 *  clflush_size:       numeric-string,
 *  cache_alignment:    numeric-string,
 *  address_sizes:      string,
 *  power_management:   string
 * }
 *
 * @template-implements \IteratorAggregate<array-key, CPUInfoArray>
 * @internal This is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\System\Linux\Native
 */
final class Reader implements \IteratorAggregate
{
    /**
     * @psalm-taint-sink file
     * @var string
     */
    private const PROC_CPUINFO = '/proc/cpuinfo';

    private function __construct()
    {
        if (!\is_readable(self::PROC_CPUINFO)) {
            throw new \LogicException('Could not determine CPU info');
        }
    }

    /**
     * @return static
     */
    public static function read(): self
    {
        return new self();
    }

    /**
     * Example Output:
     * ```
     * iterable<[
     *      "processor"         => "23"
     *      "vendor_id"         => "AuthenticAMD"
     *      "cpu_family"        => "25"
     *      "model"             => "33"
     *      "model_name"        => "AMD Ryzen 9 5900X 12-Core Processor"
     *      "stepping"          => "0"
     *      "microcode"         => "0xffffffff"
     *      "cpu_mhz"           => "4000.003"
     *      "cache_size"        => "512 KB"
     *      "physical_id"       => "0"
     *      "siblings"          => "24"
     *      "core_id"           => "11"
     *      "cpu_cores"         => "12"
     *      "apicid"            => "23"
     *      "initial_apicid"    => "23"
     *      "fpu"               => "yes"
     *      "fpu_exception"     => "yes"
     *      "cpuid_level"       => "13"
     *      "wp"                => "yes"
     *      "flags"             => "fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge etc..."
     *      "bugs"              => "sysret_ss_attrs spectre_v1 spectre_v2 spec_store_bypass"
     *      "bogomips"          => "8000.00"
     *      "tlb_size"          => "2560 4K pages"
     *      "clflush_size"      => "64"
     *      "cache_alignment"   => "64"
     *      "address_sizes"     => "48 bits physical, 48 bits virtual"
     *      "power_management"  => ""
     *  ]>
     * ```
     *
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        $info = new \SplFileObject(self::PROC_CPUINFO, 'rb');

        $buffer = [];
        while (!$info->eof()) {
            $line = \trim((string)$info->fgets());

            if ($line !== '' && \str_contains($line, ':')) {
                [$key, $value] = \explode(':', $line);
                $key = $this->formatInfoKey($key);

                $buffer[$key] = $this->formatInfoValue($value);

                continue;
            }

            if ($buffer !== []) {
                yield $buffer;
                $buffer = [];
            }
        }

        if ($buffer !== []) {
            yield from $buffer;
        }
    }

    /**
     * @param string $key
     * @return string
     */
    private function formatInfoKey(string $key): string
    {
        return \str_replace(' ', '_', \strtolower(\trim($key)));
    }

    /**
     * @param string $value
     * @return string
     */
    private function formatInfoValue(string $value): string
    {
        return \trim($value);
    }
}
