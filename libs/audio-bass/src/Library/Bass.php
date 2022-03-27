<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Audio\Bass\Library;

use FFI\Contracts\Preprocessor\Exception\DirectiveDefinitionExceptionInterface;
use FFI\Contracts\Preprocessor\Exception\PreprocessorExceptionInterface;
use FFI\Headers\Bass as BassHeader;
use FFI\Proxy\Proxy;

final class Bass extends Proxy
{
    /** All is OK */
    public const OK = 0;
    /** Memory error */
    public const ERROR_MEM = 1;
    /** Can't open the file */
    public const ERROR_FILEOPEN = 2;
    /** Can't find a free/valid driver */
    public const ERROR_DRIVER = 3;
    /** The sample buffer was lost */
    public const ERROR_BUFLOST = 4;
    /** Invalid handle */
    public const ERROR_HANDLE = 5;
    /** Unsupported sample format */
    public const ERROR_FORMAT = 6;
    /** Invalid position */
    public const ERROR_POSITION = 7;
    /** BASS_Init has not been successfully called */
    public const ERROR_INIT = 8;
    /** BASS_Start has not been successfully called */
    public const ERROR_START = 9;
    /** SSL/HTTPS support isn't available */
    public const ERROR_SSL = 10;
    /** Device needs to be reinitialized */
    public const ERROR_REINIT = 11;
    /** Already initialized/paused/whatever */
    public const ERROR_ALREADY = 14;
    /** File does not contain audio */
    public const ERROR_NOTAUDIO = 17;
    /** Can't get a free channel */
    public const ERROR_NOCHAN = 18;
    /** An illegal type was specified */
    public const ERROR_ILLTYPE = 19;
    /** An illegal parameter was specified */
    public const ERROR_ILLPARAM = 20;
    /** No 3D support */
    public const ERROR_NO3D = 21;
    /** No EAX support */
    public const ERROR_NOEAX = 22;
    /** Illegal device number */
    public const ERROR_DEVICE = 23;
    /** Not playing */
    public const ERROR_NOPLAY = 24;
    /** Illegal sample rate */
    public const ERROR_FREQ = 25;
    /** The stream is not a file stream */
    public const ERROR_NOTFILE = 27;
    /** No hardware voices available */
    public const ERROR_NOHW = 29;
    /** The MOD music has no sequence data */
    public const ERROR_EMPTY = 31;
    /** No internet connection could be opened */
    public const ERROR_NONET = 32;
    /** Couldn't create the file */
    public const ERROR_CREATE = 33;
    /** Effects are not available */
    public const ERROR_NOFX = 34;
    /** Requested data/action is not available */
    public const ERROR_NOTAVAIL = 37;
    /** The channel is/isn't a "decoding channel" */
    public const ERROR_DECODE = 38;
    /** A sufficient DirectX version is not installed */
    public const ERROR_DX = 39;
    /** Connection timedout */
    public const ERROR_TIMEOUT = 40;
    /** Unsupported file format */
    public const ERROR_FILEFORM = 41;
    /** Unavailable speaker */
    public const ERROR_SPEAKER = 42;
    /** Invalid BASS version (used by add-ons) */
    public const ERROR_VERSION = 43;
    /** Codec is not available/supported */
    public const ERROR_CODEC = 44;
    /** The channel/file has ended */
    public const ERROR_ENDED = 45;
    /** The device is busy */
    public const ERROR_BUSY = 46;
    /** Unstreamable file */
    public const ERROR_UNSTREAMABLE = 47;
    /** Unsupported protocol */
    public const ERROR_PROTOCOL = 48;
    /** Some other mystery problem */
    public const ERROR_UNKNOWN = -1;
    public const CONFIG_BUFFER = 0;
    public const CONFIG_UPDATEPERIOD = 1;
    public const CONFIG_GVOL_SAMPLE = 4;
    public const CONFIG_GVOL_STREAM = 5;
    public const CONFIG_GVOL_MUSIC = 6;
    public const CONFIG_CURVE_VOL = 7;
    public const CONFIG_CURVE_PAN = 8;
    public const CONFIG_FLOATDSP = 9;
    public const CONFIG_3DALGORITHM = 10;
    public const CONFIG_NET_TIMEOUT = 11;
    public const CONFIG_NET_BUFFER = 12;
    public const CONFIG_PAUSE_NOPLAY = 13;
    public const CONFIG_NET_PREBUF = 15;
    public const CONFIG_NET_PASSIVE = 18;
    public const CONFIG_REC_BUFFER = 19;
    public const CONFIG_NET_PLAYLIST = 21;
    public const CONFIG_MUSIC_VIRTUAL = 22;
    public const CONFIG_VERIFY = 23;
    public const CONFIG_UPDATETHREADS = 24;
    public const CONFIG_DEV_BUFFER = 27;
    public const CONFIG_REC_LOOPBACK = 28;
    public const CONFIG_VISTA_TRUEPOS = 30;
    public const CONFIG_IOS_SESSION = 34;
    public const CONFIG_IOS_MIXAUDIO = 34;
    public const CONFIG_DEV_DEFAULT = 36;
    public const CONFIG_NET_READTIMEOUT = 37;
    public const CONFIG_VISTA_SPEAKERS = 38;
    public const CONFIG_IOS_SPEAKER = 39;
    public const CONFIG_MF_DISABLE = 40;
    public const CONFIG_HANDLES = 41;
    public const CONFIG_UNICODE = 42;
    public const CONFIG_SRC = 43;
    public const CONFIG_SRC_SAMPLE = 44;
    public const CONFIG_ASYNCFILE_BUFFER = 45;
    public const CONFIG_OGG_PRESCAN = 47;
    public const CONFIG_MF_VIDEO = 48;
    public const CONFIG_AIRPLAY = 49;
    public const CONFIG_DEV_NONSTOP = 50;
    public const CONFIG_IOS_NOCATEGORY = 51;
    public const CONFIG_VERIFY_NET = 52;
    public const CONFIG_DEV_PERIOD = 53;
    public const CONFIG_FLOAT = 54;
    public const CONFIG_NET_SEEK = 56;
    public const CONFIG_AM_DISABLE = 58;
    public const CONFIG_NET_PLAYLIST_DEPTH = 59;
    public const CONFIG_NET_PREBUF_WAIT = 60;
    public const CONFIG_ANDROID_SESSIONID = 62;
    public const CONFIG_WASAPI_PERSIST = 65;
    public const CONFIG_REC_WASAPI = 66;
    public const CONFIG_ANDROID_AAUDIO = 67;
    public const CONFIG_SAMPLE_ONEHANDLE = 69;
    public const CONFIG_DEV_TIMEOUT = 70;
    public const CONFIG_NET_META = 71;
    public const CONFIG_NET_RESTRATE = 72;
    public const CONFIG_NET_AGENT = 16;
    public const CONFIG_NET_PROXY = 17;
    public const CONFIG_IOS_NOTIFY = 46;
    public const CONFIG_LIBSSL = 64;
    /** Flag: thread-specific setting */
    public const CONFIG_THREAD = 0x40000000;
    public const IOS_SESSION_MIX = 1;
    public const IOS_SESSION_DUCK = 2;
    public const IOS_SESSION_AMBIENT = 4;
    public const IOS_SESSION_SPEAKER = 8;
    public const IOS_SESSION_DISABLE = 16;
    /** Unused */
    public const DEVICE_8BITS = 1;
    /** Mono */
    public const DEVICE_MONO = 2;
    /** Unused */
    public const DEVICE_3D = 4;
    /** Limit output to 16-bit */
    public const DEVICE_16BITS = 8;
    /** Reinitialize */
    public const DEVICE_REINIT = 128;
    /** Unused */
    public const DEVICE_LATENCY = 0x100;
    /** Unused */
    public const DEVICE_CPSPEAKERS = 0x400;
    /** Force enabling of speaker assignment */
    public const DEVICE_SPEAKERS = 0x800;
    /** Ignore speaker arrangement */
    public const DEVICE_NOSPEAKER = 0x1000;
    /** Use ALSA "dmix" plugin */
    public const DEVICE_DMIX = 0x2000;
    /** Set device sample rate */
    public const DEVICE_FREQ = 0x4000;
    /** Limit output to stereo */
    public const DEVICE_STEREO = 0x8000;
    /** Hog/exclusive mode */
    public const DEVICE_HOG = 0x10000;
    /** Use AudioTrack output */
    public const DEVICE_AUDIOTRACK = 0x20000;
    /** Use DirectSound output */
    public const DEVICE_DSOUND = 0x40000;
    /** Disable hardware/fastpath output */
    public const DEVICE_SOFTWARE = 0x80000;
    /** IDirectSound */
    public const OBJECT_DS = 1;
    /** IDirectSound3DListener */
    public const OBJECT_DS3DL = 2;
    public const DEVICE_ENABLED = 1;
    public const DEVICE_DEFAULT = 2;
    public const DEVICE_INIT = 4;
    public const DEVICE_LOOPBACK = 8;
    public const DEVICE_DEFAULTCOM = 128;
    public const DEVICE_TYPE_MASK = 0xff000000;
    public const DEVICE_TYPE_NETWORK = 0x01000000;
    public const DEVICE_TYPE_SPEAKERS = 0x02000000;
    public const DEVICE_TYPE_LINE = 0x03000000;
    public const DEVICE_TYPE_HEADPHONES = 0x04000000;
    public const DEVICE_TYPE_MICROPHONE = 0x05000000;
    public const DEVICE_TYPE_HEADSET = 0x06000000;
    public const DEVICE_TYPE_HANDSET = 0x07000000;
    public const DEVICE_TYPE_DIGITAL = 0x08000000;
    public const DEVICE_TYPE_SPDIF = 0x09000000;
    public const DEVICE_TYPE_HDMI = 0x0a000000;
    public const DEVICE_TYPE_DISPLAYPORT = 0x40000000;
    public const DEVICES_AIRPLAY = 0x1000000;
    /** Device does not have hardware DirectSound support */
    public const DSCAPS_EMULDRIVER = 0x00000020;
    /** Device driver has been certified by Microsoft */
    public const DSCAPS_CERTIFIED = 0x00000040;
    /** Hardware mixed */
    public const DSCAPS_HARDWARE = 0x80000000;
    /** Device does not have hardware DirectSound recording support */
    public const DSCCAPS_EMULDRIVER = self::DSCAPS_EMULDRIVER;
    /** Device driver has been certified by Microsoft */
    public const DSCCAPS_CERTIFIED = self::DSCAPS_CERTIFIED;
    /* 11.025 kHz, Mono,   8-bit  */
    public const WAVE_FORMAT_1M08 = 0x00000001;
    /* 11.025 kHz, Stereo, 8-bit  */
    public const WAVE_FORMAT_1S08 = 0x00000002;
    /* 11.025 kHz, Mono,   16-bit */
    public const WAVE_FORMAT_1M16 = 0x00000004;
    /* 11.025 kHz, Stereo, 16-bit */
    public const WAVE_FORMAT_1S16 = 0x00000008;
    /* 22.05  kHz, Mono,   8-bit  */
    public const WAVE_FORMAT_2M08 = 0x00000010;
    /* 22.05  kHz, Stereo, 8-bit  */
    public const WAVE_FORMAT_2S08 = 0x00000020;
    /* 22.05  kHz, Mono,   16-bit */
    public const WAVE_FORMAT_2M16 = 0x00000040;
    /* 22.05  kHz, Stereo, 16-bit */
    public const WAVE_FORMAT_2S16 = 0x00000080;
    /* 44.1   kHz, Mono,   8-bit  */
    public const WAVE_FORMAT_4M08 = 0x00000100;
    /* 44.1   kHz, Stereo, 8-bit  */
    public const WAVE_FORMAT_4S08 = 0x00000200;
    /* 44.1   kHz, Mono,   16-bit */
    public const WAVE_FORMAT_4M16 = 0x00000400;
    /* 44.1   kHz, Stereo, 16-bit */
    public const WAVE_FORMAT_4S16 = 0x00000800;
    /** 8 bit */
    public const SAMPLE_8BITS = 1;
    /** 32 bit floating-point */
    public const SAMPLE_FLOAT = 256;
    /** Mono */
    public const SAMPLE_MONO = 2;
    /** Looped */
    public const SAMPLE_LOOP = 4;
    /** 3D functionality */
    public const SAMPLE_3D = 8;
    /** Unused */
    public const SAMPLE_SOFTWARE = 16;
    /** Mute at max distance (3D only) */
    public const SAMPLE_MUTEMAX = 32;
    /** Unused */
    public const SAMPLE_VAM = 64;
    /** Unused */
    public const SAMPLE_FX = 128;
    /** Override lowest volume */
    public const SAMPLE_OVER_VOL = 0x10000;
    /** Override longest playing */
    public const SAMPLE_OVER_POS = 0x20000;
    /** Override furthest from listener (3D only) */
    public const SAMPLE_OVER_DIST = 0x30000;
    /** Scan file for accurate seeking and length */
    public const STREAM_PRESCAN = 0x20000;
    /** Automatically free the stream when it stops/ends */
    public const STREAM_AUTOFREE = 0x40000;
    /** Restrict the download rate of internet file stream */
    public const STREAM_RESTRATE = 0x80000;
    /** Download internet file stream in small blocks */
    public const STREAM_BLOCK = 0x100000;
    /** Don't play the stream, only decode */
    public const STREAM_DECODE = 0x200000;
    /** Give server status info (HTTP/ICY tags) in DOWNLOADPROC */
    public const STREAM_STATUS = 0x800000;
    /** Ignore LAME/Xing/VBRI/iTunes delay & padding info */
    public const MP3_IGNOREDELAY = 0x200;
    public const MP3_SETPOS = self::STREAM_PRESCAN;
    public const MUSIC_FLOAT = self::SAMPLE_FLOAT;
    public const MUSIC_MONO = self::SAMPLE_MONO;
    public const MUSIC_LOOP = self::SAMPLE_LOOP;
    public const MUSIC_3D = self::SAMPLE_3D;
    public const MUSIC_FX = self::SAMPLE_FX;
    public const MUSIC_AUTOFREE = self::STREAM_AUTOFREE;
    public const MUSIC_DECODE = self::STREAM_DECODE;
    /** Calculate playback length */
    public const MUSIC_PRESCAN = self::STREAM_PRESCAN;
    public const MUSIC_CALCLEN = self::MUSIC_PRESCAN;
    /** Normal ramping */
    public const MUSIC_RAMP = 0x200;
    /** Sensitive ramping */
    public const MUSIC_RAMPS = 0x400;
    /** Surround sound */
    public const MUSIC_SURROUND = 0x800;
    /** Surround sound (mode 2) */
    public const MUSIC_SURROUND2 = 0x1000;
    /** Apply FastTracker 2 panning to XM files */
    public const MUSIC_FT2PAN = 0x2000;
    /** Play .MOD as FastTracker 2 does */
    public const MUSIC_FT2MOD = 0x2000;
    /** Play .MOD as ProTracker 1 does */
    public const MUSIC_PT1MOD = 0x4000;
    /** Non-interpolated sample mixing */
    public const MUSIC_NONINTER = 0x10000;
    /** Sinc interpolated sample mixing */
    public const MUSIC_SINCINTER = 0x800000;
    /** Stop all notes when moving position */
    public const MUSIC_POSRESET = 0x8000;
    /** Stop all notes and reset bmp/etc when moving position */
    public const MUSIC_POSRESETEX = 0x400000;
    /** Stop the music on a backwards jump effect */
    public const MUSIC_STOPBACK = 0x80000;
    /** Don't load the samples */
    public const MUSIC_NOSAMPLE = 0x100000;
    /** Front speakers */
    public const SPEAKER_FRONT = 0x1000000;
    /** Rear/side speakers */
    public const SPEAKER_REAR = 0x2000000;
    /** Center & LFE speakers (5.1) */
    public const SPEAKER_CENLFE = 0x3000000;
    /** Rear center speakers (7.1) */
    public const SPEAKER_REAR2 = 0x4000000;
    /** Modifier: left */
    public const SPEAKER_LEFT = 0x10000000;
    /** Modifier: right */
    public const SPEAKER_RIGHT = 0x20000000;
    public const SPEAKER_FRONTLEFT = self::SPEAKER_FRONT | self::SPEAKER_LEFT;
    public const SPEAKER_FRONTRIGHT = self::SPEAKER_FRONT | self::SPEAKER_RIGHT;
    public const SPEAKER_REARLEFT = self::SPEAKER_REAR | self::SPEAKER_LEFT;
    public const SPEAKER_REARRIGHT = self::SPEAKER_REAR | self::SPEAKER_RIGHT;
    public const SPEAKER_CENTER = self::SPEAKER_CENLFE | self::SPEAKER_LEFT;
    public const SPEAKER_LFE = self::SPEAKER_CENLFE | self::SPEAKER_RIGHT;
    public const SPEAKER_REAR2LEFT = self::SPEAKER_REAR2 | self::SPEAKER_LEFT;
    public const SPEAKER_REAR2RIGHT = self::SPEAKER_REAR2 | self::SPEAKER_RIGHT;
    /** Read file asynchronously */
    public const ASYNCFILE = 0x40000000;
    /** UTF-16 */
    public const UNICODE = 0x80000000;
    /** Start recording paused */
    public const RECORD_PAUSE = 0x8000;
    public const RECORD_ECHOCANCEL = 0x2000;
    public const RECORD_AGC = 0x4000;
    public const VAM_HARDWARE = 1;
    public const VAM_SOFTWARE = 2;
    public const VAM_TERM_TIME = 4;
    public const VAM_TERM_DIST = 8;
    public const VAM_TERM_PRIO = 16;
    public const ORIGRES_FLOAT = 0x10000;
    public const CTYPE_SAMPLE = 1;
    public const CTYPE_RECORD = 2;
    public const CTYPE_STREAM = 0x10000;
    public const CTYPE_STREAM_VORBIS = 0x10002;
    public const CTYPE_STREAM_OGG = 0x10002;
    public const CTYPE_STREAM_MP1 = 0x10003;
    public const CTYPE_STREAM_MP2 = 0x10004;
    public const CTYPE_STREAM_MP3 = 0x10005;
    public const CTYPE_STREAM_AIFF = 0x10006;
    public const CTYPE_STREAM_CA = 0x10007;
    public const CTYPE_STREAM_MF = 0x10008;
    public const CTYPE_STREAM_AM = 0x10009;
    public const CTYPE_STREAM_SAMPLE = 0x1000a;
    public const CTYPE_STREAM_DUMMY = 0x18000;
    public const CTYPE_STREAM_DEVICE = 0x18001;
    /** WAVE flag (LOWORD=codec) */
    public const CTYPE_STREAM_WAV = 0x40000;
    public const CTYPE_STREAM_WAV_PCM = 0x50001;
    public const CTYPE_STREAM_WAV_FLOAT = 0x50003;
    public const CTYPE_MUSIC_MOD = 0x20000;
    public const CTYPE_MUSIC_MTM = 0x20001;
    public const CTYPE_MUSIC_S3M = 0x20002;
    public const CTYPE_MUSIC_XM = 0x20003;
    public const CTYPE_MUSIC_IT = 0x20004;
    /** MO3 flag */
    public const CTYPE_MUSIC_MO3 = 0x00100;
    /** Normal 3D processing */
    public const BASS_3DMODE_NORMAL = 0;
    /** Position is relative to the listener */
    public const BASS_3DMODE_RELATIVE = 1;
    /** No 3D processing */
    public const BASS_3DMODE_OFF = 2;
    public const BASS_3DALG_DEFAULT = 0;
    public const BASS_3DALG_OFF = 1;
    public const BASS_3DALG_FULL = 2;
    public const BASS_3DALG_LIGHT = 3;
    /** Get a new playback channel */
    public const SAMCHAN_NEW = 1;
    /** Create a stream */
    public const SAMCHAN_STREAM = 2;
    /** End of user stream flag */
    public const STREAMPROC_END = 0x80000000;
    public const STREAMFILE_NOBUFFER = 0;
    public const STREAMFILE_BUFFER = 1;
    public const STREAMFILE_BUFFERPUSH = 2;
    /** End & close the file */
    public const FILEDATA_END = 0;
    public const FILEPOS_CURRENT = 0;
    public const FILEPOS_DECODE = self::FILEPOS_CURRENT;
    public const FILEPOS_DOWNLOAD = 1;
    public const FILEPOS_END = 2;
    public const FILEPOS_START = 3;
    public const FILEPOS_CONNECTED = 4;
    public const FILEPOS_BUFFER = 5;
    public const FILEPOS_SOCKET = 6;
    public const FILEPOS_ASYNCBUF = 7;
    public const FILEPOS_SIZE = 8;
    public const FILEPOS_BUFFERING = 9;
    public const FILEPOS_AVAILABLE = 10;
    public const SYNC_POS = 0;
    public const SYNC_END = 2;
    public const SYNC_META = 4;
    public const SYNC_SLIDE = 5;
    public const SYNC_STALL = 6;
    public const SYNC_DOWNLOAD = 7;
    public const SYNC_FREE = 8;
    public const SYNC_SETPOS = 11;
    public const SYNC_MUSICPOS = 10;
    public const SYNC_MUSICINST = 1;
    public const SYNC_MUSICFX = 3;
    public const SYNC_OGG_CHANGE = 12;
    public const SYNC_DEV_FAIL = 14;
    public const SYNC_DEV_FORMAT = 15;
    /** Flag: call sync in other thread */
    public const SYNC_THREAD = 0x20000000;
    /** Flag: sync at mixtime, else at playtime */
    public const SYNC_MIXTIME = 0x40000000;
    /** Flag: sync only once, else continuously */
    public const SYNC_ONETIME = 0x80000000;
    public const ACTIVE_STOPPED = 0;
    public const ACTIVE_PLAYING = 1;
    public const ACTIVE_STALLED = 2;
    public const ACTIVE_PAUSED = 3;
    public const ACTIVE_PAUSED_DEVICE = 4;
    public const ATTRIB_FREQ = 1;
    public const ATTRIB_VOL = 2;
    public const ATTRIB_PAN = 3;
    public const ATTRIB_EAXMIX = 4;
    public const ATTRIB_NOBUFFER = 5;
    public const ATTRIB_VBR = 6;
    public const ATTRIB_CPU = 7;
    public const ATTRIB_SRC = 8;
    public const ATTRIB_NET_RESUME = 9;
    public const ATTRIB_SCANINFO = 10;
    public const ATTRIB_NORAMP = 11;
    public const ATTRIB_BITRATE = 12;
    public const ATTRIB_BUFFER = 13;
    public const ATTRIB_GRANULE = 14;
    public const ATTRIB_USER = 15;
    public const ATTRIB_TAIL = 16;
    public const ATTRIB_PUSH_LIMIT = 17;
    public const ATTRIB_MUSIC_AMPLIFY = 0x100;
    public const ATTRIB_MUSIC_PANSEP = 0x101;
    public const ATTRIB_MUSIC_PSCALER = 0x102;
    public const ATTRIB_MUSIC_BPM = 0x103;
    public const ATTRIB_MUSIC_SPEED = 0x104;
    public const ATTRIB_MUSIC_VOL_GLOBAL = 0x105;
    public const ATTRIB_MUSIC_ACTIVE = 0x106;
    public const ATTRIB_MUSIC_VOL_CHAN = 0x200; // + channel #
    public const ATTRIB_MUSIC_VOL_INST = 0x300; // + instrument #
    public const SLIDE_LOG = 0x1000000;
    /** Query how much data is buffered */
    public const DATA_AVAILABLE = 0;
    /** Flag: don't remove data from recording buffer */
    public const DATA_NOREMOVE = 0x10000000;
    /** Flag: return 8.24 fixed-point data */
    public const DATA_FIXED = 0x20000000;
    /** Flag: return floating-point sample data */
    public const DATA_FLOAT = 0x40000000;
    /** 256 sample FFT */
    public const DATA_FFT256 = 0x80000000;
    /** 512 FFT */
    public const DATA_FFT512 = 0x80000001;
    /** 1024 FFT */
    public const DATA_FFT1024 = 0x80000002;
    /** 2048 FFT */
    public const DATA_FFT2048 = 0x80000003;
    /** 4096 FFT */
    public const DATA_FFT4096 = 0x80000004;
    /** 8192 FFT */
    public const DATA_FFT8192 = 0x80000005;
    /** 16384 FFT */
    public const DATA_FFT16384 = 0x80000006;
    /** 32768 FFT */
    public const DATA_FFT32768 = 0x80000007;
    /** FFT flag: FFT for each channel, else all combined */
    public const DATA_FFT_INDIVIDUAL = 0x10;
    /** FFT flag: no Hanning window */
    public const DATA_FFT_NOWINDOW = 0x20;
    /** FFT flag: pre-remove DC bias */
    public const DATA_FFT_REMOVEDC = 0x40;
    /** FFT flag: return complex data */
    public const DATA_FFT_COMPLEX = 0x80;
    /** FFT flag: return extra Nyquist value */
    public const DATA_FFT_NYQUIST = 0x100;
    /** Get mono level */
    public const LEVEL_MONO = 1;
    /** Get stereo level */
    public const LEVEL_STEREO = 2;
    /** Get RMS levels */
    public const LEVEL_RMS = 4;
    /** Apply VOL/PAN attributes to the levels */
    public const LEVEL_VOLPAN = 8;
    /** Don't remove data from recording buffer */
    public const LEVEL_NOREMOVE = 16;
    /** ID3v1 tags : TAG_ID3 structure */
    public const TAG_ID3 = 0;
    /** ID3v2 tags : variable length block */
    public const TAG_ID3V2 = 1;
    /** OGG comments : series of null-terminated UTF-8 strings */
    public const TAG_OGG = 2;
    /** HTTP headers : series of null-terminated ASCII strings */
    public const TAG_HTTP = 3;
    /** ICY headers : series of null-terminated ANSI strings */
    public const TAG_ICY = 4;
    /** ICY metadata : ANSI string */
    public const TAG_META = 5;
    /** APE tags : series of null-terminated UTF-8 strings */
    public const TAG_APE = 6;
    /** MP4/iTunes metadata : series of null-terminated UTF-8 strings */
    public const TAG_MP4 = 7;
    /** WMA tags : series of null-terminated UTF-8 strings */
    public const TAG_WMA = 8;
    /** OGG encoder : UTF-8 string */
    public const TAG_VENDOR = 9;
    /** Lyric3v2 tag : ASCII string */
    public const TAG_LYRICS3 = 10;
    /** CoreAudio codec info : TAG_CA_CODEC structure */
    public const TAG_CA_CODEC = 11;
    /** Media Foundation tags : series of null-terminated UTF-8 strings */
    public const TAG_MF = 13;
    /** WAVE format : WAVEFORMATEEX structure */
    public const TAG_WAVEFORMAT = 14;
    /** Android Media codec name : ASCII string */
    public const TAG_AM_NAME = 16;
    /** ID3v2 tags (2nd block) : variable length block */
    public const TAG_ID3V2_2 = 17;
    /** Android Media MIME type : ASCII string */
    public const TAG_AM_MIME = 18;
    /** Redirected URL : ASCII string */
    public const TAG_LOCATION = 19;
    /** RIFF "INFO" tags : series of null-terminated ANSI strings */
    public const TAG_RIFF_INFO = 0x100;
    /** RIFF/BWF "bext" tags : TAG_BEXT structure */
    public const TAG_RIFF_BEXT = 0x101;
    /** RIFF/BWF "cart" tags : TAG_CART structure */
    public const TAG_RIFF_CART = 0x102;
    /** RIFF "DISP" text tag : ANSI string */
    public const TAG_RIFF_DISP = 0x103;
    /** RIFF "cue " chunk : TAG_CUE structure */
    public const TAG_RIFF_CUE = 0x104;
    /** RIFF "smpl" chunk : TAG_SMPL structure */
    public const TAG_RIFF_SMPL = 0x105;
    public const TAG_APE_BINARY = 0x1000;    // + index #, binary APE tag : TAG_APE_BINARY structure
    /** MOD music name : ANSI string */
    public const TAG_MUSIC_NAME = 0x10000;
    /** MOD message : ANSI string */
    public const TAG_MUSIC_MESSAGE = 0x10001;
    /** MOD order list : BYTE array of pattern numbers */
    public const TAG_MUSIC_ORDERS = 0x10002;
    /** MOD author : UTF-8 string */
    public const TAG_MUSIC_AUTH = 0x10003;
    public const TAG_MUSIC_INST = 0x10100;    // + instrument #, MOD instrument name : ANSI string
    public const TAG_MUSIC_CHAN = 0x10200;    // + channel #, MOD channel name : ANSI string
    public const TAG_MUSIC_SAMPLE = 0x10300;    // + sample #, MOD sample name : ANSI string
    /** Byte position */
    public const POS_BYTE = 0;
    /** Order.row position, MAKELONG(order,row) */
    public const POS_MUSIC_ORDER = 1;
    /** OGG bitstream number */
    public const POS_OGG = 3;
    /** Trimmed end position */
    public const POS_END = 0x10;
    /** Loop start positiom */
    public const POS_LOOP = 0x11;
    /** Flag: flush decoder/FX buffers */
    public const POS_FLUSH = 0x1000000;
    /** Flag: reset user file buffers */
    public const POS_RESET = 0x2000000;
    /** Flag: seek relative to the current position */
    public const POS_RELATIVE = 0x4000000;
    /** Flag: allow seeking to inexact position */
    public const POS_INEXACT = 0x8000000;
    /** Flag: get the decoding (not playing) position */
    public const POS_DECODE = 0x10000000;
    /** Flag: decode to the position instead of seeking */
    public const POS_DECODETO = 0x20000000;
    /** Flag: scan to the position */
    public const POS_SCAN = 0x40000000;
    public const NODEVICE = 0x20000;
    public const INPUT_OFF = 0x10000;
    public const INPUT_ON = 0x20000;
    public const INPUT_TYPE_MASK = 0xff000000;
    public const INPUT_TYPE_UNDEF = 0x00000000;
    public const INPUT_TYPE_DIGITAL = 0x01000000;
    public const INPUT_TYPE_LINE = 0x02000000;
    public const INPUT_TYPE_MIC = 0x03000000;
    public const INPUT_TYPE_SYNTH = 0x04000000;
    public const INPUT_TYPE_CD = 0x05000000;
    public const INPUT_TYPE_PHONE = 0x06000000;
    public const INPUT_TYPE_SPEAKER = 0x07000000;
    public const INPUT_TYPE_WAVE = 0x08000000;
    public const INPUT_TYPE_AUX = 0x09000000;
    public const INPUT_TYPE_ANALOG = 0x0a000000;
    public const FX_DX8_CHORUS = 0;
    public const FX_DX8_COMPRESSOR = 1;
    public const FX_DX8_DISTORTION = 2;
    public const FX_DX8_ECHO = 3;
    public const FX_DX8_FLANGER = 4;
    public const FX_DX8_GARGLE = 5;
    public const FX_DX8_I3DL2REVERB = 6;
    public const FX_DX8_PARAMEQ = 7;
    public const FX_DX8_REVERB = 8;
    public const FX_VOLUME = 9;
    public const DX8_PHASE_NEG_180 = 0;
    public const DX8_PHASE_NEG_90 = 1;
    public const DX8_PHASE_ZERO = 2;
    public const DX8_PHASE_90 = 3;
    public const DX8_PHASE_180 = 4;

    /**
     * @psalm-taint-sink file $library
     * @param non-empty-string $library
     * @throws DirectiveDefinitionExceptionInterface
     * @throws PreprocessorExceptionInterface
     */
    public function __construct(string $library)
    {
        $headers = BassHeader::create(match (\PHP_OS_FAMILY) {
            'Windows' => BassHeader\Platform::WINDOWS,
            'Linux' => BassHeader\Platform::LINUX,
            'Darwin' => BassHeader\Platform::DARWIN,
        });

        parent::__construct(\FFI::cdef((string)$headers, $library));
    }
}
