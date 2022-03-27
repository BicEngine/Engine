
typedef char            CHAR;
typedef char            WCHAR;
typedef const CHAR      *LPCSTR;
typedef const WCHAR     *LPCWSTR;
typedef void            *HINSTANCE;
typedef HINSTANCE       HMODULE;

HMODULE GetModuleHandleA(LPCSTR lpModuleName);
HMODULE GetModuleHandleW(LPCWSTR lpModuleName);
