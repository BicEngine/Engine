typedef struct SystemInfo {
  __extension__ union {
    uint32_t dwOemId;
    __extension__ struct {
        uint16_t wProcessorArchitecture;
        uint16_t wReserved;
    };
  };
  uint32_t  dwPageSize;
  void*     lpMinimumApplicationAddress;
  void*     lpMaximumApplicationAddress;
  size_t    dwActiveProcessorMask;
  uint32_t  dwNumberOfProcessors;
  uint32_t  dwProcessorType;
  uint32_t  dwAllocationGranularity;
  uint16_t   wProcessorLevel;
  uint16_t   wProcessorRevision;
} SystemInfo;

void GetSystemInfo(SystemInfo*);
bool IsProcessorFeaturePresent(uint32_t ProcessorFeature);
