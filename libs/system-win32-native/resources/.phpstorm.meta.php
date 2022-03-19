<?php

namespace PHPSTORM_META {

    override(\Bic\System\Win32\Native\Api\Kernel32::new(0), map([
        '' => 'Bic\System\Win32\Native\@'
    ]));

}

namespace Bic\System\Win32\Native {

    use FFI\CData;

    /**
     * @internal This is an internal library class, please do not use it in your code.
     * @psalm-internal Bic\System\Win32
     */
    final class SystemInfo extends CData
    {
        public int $dwOemId = 0;
        public int $wProcessorArchitecture = 0;
        public int $wReserved = 0;
        public int $dwPageSize = 0;
        public ?CData $lpMinimumApplicationAddress = null;
        public ?CData $lpMaximumApplicationAddress = null;
        public int $dwActiveProcessorMask = 0;
        public int $dwNumberOfProcessors = 0;
        public int $dwProcessorType = 0;
        public int $dwAllocationGranularity = 0;
        public int $wProcessorLevel = 0;
        public int $wProcessorRevision = 0;

        private function __construct()
        {
        }
    }
}
