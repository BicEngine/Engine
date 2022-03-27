<?php

namespace Bic\Ui\Win32 {

    use FFI\CData;

    final class HINSTANCE extends CData
    {
        private function __construct() {}
    }

    final class HWND extends CData
    {
        private function __construct() {}
    }

    final class HICON extends CData
    {
        private function __construct() {}
    }

    final class HCURSOR extends CData
    {
        private function __construct() {}
    }

    final class HBRUSH extends CData
    {
        private function __construct() {}
    }

    final class LPCWSTR extends CData
    {
        public string $cdata;
        private function __construct() {}
    }

    final class WNDCLASSW extends CData
    {
        /**
         * @var positive-int|0
         */
        public int $style = 0;
        public ?\Closure $lpfnWndProc = null;
        public int $cbClsExtra = 0;
        public int $cbWndExtra = 0;
        public ?HINSTANCE $hInstance = null;
        public ?HICON $hIcon = null;
        public ?HCURSOR $hCursor = null;
        public ?HBRUSH $hbrBackground = null;
        public ?LPCWSTR $lpszMenuName = null;
        public ?LPCWSTR $lpszClassName = null;
        private function __construct() {}
    }

    final class POINT extends CData
    {
        public int $x = 0;
        public int $y = 0;
        private function __construct() {}
    }

    final class MSG extends CData
    {
        public ?HWND $hwnd = null;
        /** @var positive-int|0 */
        public int $message = 0;
        /** @var positive-int|0 */
        public int $wParam = 0;
        /** @var positive-int|0 */
        public int $lParam = 0;
        /** @var positive-int|0 */
        public int $time = 0;
        public ?POINT $pt = null;
        private function __construct() {}
    }

    final class RECT extends CData
    {
        public int $left = 0;
        public int $top = 0;
        public int $right = 0;
        public int $bottom = 0;
        private function __construct() {}
    }
}
