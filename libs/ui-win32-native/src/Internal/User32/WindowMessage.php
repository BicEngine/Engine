<?php

/**
 * This file is part of Ui package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Win32\Native\Internal\User32;

/**
 * @internal WindowMessage is an internal library class, please do not use it in your code.
 * @psalm-internal Bic\Ui\Win32
 *
 * @link https://docs.microsoft.com/ru-ru/windows/win32/winmsg/window-notifications
 */
final class WindowMessage
{
    public const WM_NULL                           = 0x0000;
    public const WM_CREATE                         = 0x0001;
    public const WM_DESTROY                        = 0x0002;
    public const WM_MOVE                           = 0x0003;
    public const WM_SIZE                           = 0x0005;
    public const WM_ACTIVATE                       = 0x0006;
    public const WM_SETFOCUS                       = 0x0007;
    public const WM_KILLFOCUS                      = 0x0008;
    public const WM_ENABLE                         = 0x000A;
    public const WM_SETREDRAW                      = 0x000B;
    public const WM_SETTEXT                        = 0x000C;
    public const WM_GETTEXT                        = 0x000D;
    public const WM_GETTEXTLENGTH                  = 0x000E;
    public const WM_PAINT                          = 0x000F;
    public const WM_CLOSE                          = 0x0010;
    public const WM_QUERYENDSESSION                = 0x0011;
    public const WM_QUERYOPEN                      = 0x0013;
    public const WM_ENDSESSION                     = 0x0016;
    public const WM_QUIT                           = 0x0012;
    public const WM_ERASEBKGND                     = 0x0014;
    public const WM_SYSCOLORCHANGE                 = 0x0015;
    public const WM_SHOWWINDOW                     = 0x0018;
    public const WM_WININICHANGE                   = 0x001A;
    public const WM_SETTINGCHANGE                  = self::WM_WININICHANGE;
    public const WM_DEVMODECHANGE                  = 0x001B;
    public const WM_ACTIVATEAPP                    = 0x001C;
    public const WM_FONTCHANGE                     = 0x001D;
    public const WM_TIMECHANGE                     = 0x001E;
    public const WM_CANCELMODE                     = 0x001F;
    public const WM_SETCURSOR                      = 0x0020;
    public const WM_MOUSEACTIVATE                  = 0x0021;
    public const WM_CHILDACTIVATE                  = 0x0022;
    public const WM_QUEUESYNC                      = 0x0023;
    public const WM_GETMINMAXINFO                  = 0x0024;
    public const WM_PAINTICON                      = 0x0026;
    public const WM_ICONERASEBKGND                 = 0x0027;
    public const WM_NEXTDLGCTL                     = 0x0028;
    public const WM_SPOOLERSTATUS                  = 0x002A;
    public const WM_DRAWITEM                       = 0x002B;
    public const WM_MEASUREITEM                    = 0x002C;
    public const WM_DELETEITEM                     = 0x002D;
    public const WM_VKEYTOITEM                     = 0x002E;
    public const WM_CHARTOITEM                     = 0x002F;
    public const WM_SETFONT                        = 0x0030;
    public const WM_GETFONT                        = 0x0031;
    public const WM_SETHOTKEY                      = 0x0032;
    public const WM_GETHOTKEY                      = 0x0033;
    public const WM_QUERYDRAGICON                  = 0x0037;
    public const WM_COMPAREITEM                    = 0x0039;
    public const WM_GETOBJECT                      = 0x003D;
    public const WM_COMPACTING                     = 0x0041;
    public const WM_WINDOWPOSCHANGING              = 0x0046;
    public const WM_WINDOWPOSCHANGED               = 0x0047;
    public const WM_POWER                          = 0x0048;
    public const WM_COPYDATA                       = 0x004A;
    public const WM_CANCELJOURNAL                  = 0x004B;
    public const WM_NOTIFY                         = 0x004E;
    public const WM_INPUTLANGCHANGEREQUEST         = 0x0050;
    public const WM_INPUTLANGCHANGE                = 0x0051;
    public const WM_TCARD                          = 0x0052;
    public const WM_HELP                           = 0x0053;
    public const WM_USERCHANGED                    = 0x0054;
    public const WM_NOTIFYFORMAT                   = 0x0055;
    public const WM_CONTEXTMENU                    = 0x007B;
    public const WM_STYLECHANGING                  = 0x007C;
    public const WM_STYLECHANGED                   = 0x007D;
    public const WM_DISPLAYCHANGE                  = 0x007E;
    public const WM_GETICON                        = 0x007F;
    public const WM_SETICON                        = 0x0080;
    public const WM_NCCREATE                       = 0x0081;
    public const WM_NCDESTROY                      = 0x0082;
    public const WM_NCCALCSIZE                     = 0x0083;
    public const WM_NCHITTEST                      = 0x0084;
    public const WM_NCPAINT                        = 0x0085;
    public const WM_NCACTIVATE                     = 0x0086;
    public const WM_GETDLGCODE                     = 0x0087;
    public const WM_SYNCPAINT                      = 0x0088;
    public const WM_NCMOUSEMOVE                    = 0x00A0;
    public const WM_NCLBUTTONDOWN                  = 0x00A1;
    public const WM_NCLBUTTONUP                    = 0x00A2;
    public const WM_NCLBUTTONDBLCLK                = 0x00A3;
    public const WM_NCRBUTTONDOWN                  = 0x00A4;
    public const WM_NCRBUTTONUP                    = 0x00A5;
    public const WM_NCRBUTTONDBLCLK                = 0x00A6;
    public const WM_NCMBUTTONDOWN                  = 0x00A7;
    public const WM_NCMBUTTONUP                    = 0x00A8;
    public const WM_NCMBUTTONDBLCLK                = 0x00A9;
    public const WM_NCXBUTTONDOWN                  = 0x00AB;
    public const WM_NCXBUTTONUP                    = 0x00AC;
    public const WM_NCXBUTTONDBLCLK                = 0x00AD;
    public const WM_INPUT_DEVICE_CHANGE            = 0x00FE;
    public const WM_INPUT                          = 0x00FF;
    public const WM_KEYDOWN                        = 0x0100;
    public const WM_KEYUP                          = 0x0101;
    public const WM_CHAR                           = 0x0102;
    public const WM_DEADCHAR                       = 0x0103;
    public const WM_SYSKEYDOWN                     = 0x0104;
    public const WM_SYSKEYUP                       = 0x0105;
    public const WM_SYSCHAR                        = 0x0106;
    public const WM_SYSDEADCHAR                    = 0x0107;
    public const WM_UNICHAR                        = 0x0109;
    public const WM_IME_STARTCOMPOSITION           = 0x010D;
    public const WM_IME_ENDCOMPOSITION             = 0x010E;
    public const WM_IME_COMPOSITION                = 0x010F;
    public const WM_INITDIALOG                     = 0x0110;
    public const WM_COMMAND                        = 0x0111;
    public const WM_SYSCOMMAND                     = 0x0112;
    public const WM_TIMER                          = 0x0113;
    public const WM_HSCROLL                        = 0x0114;
    public const WM_VSCROLL                        = 0x0115;
    public const WM_INITMENU                       = 0x0116;
    public const WM_INITMENUPOPUP                  = 0x0117;
    public const WM_GESTURE                        = 0x0119;
    public const WM_GESTURENOTIFY                  = 0x011A;
    public const WM_MENUSELECT                     = 0x011F;
    public const WM_MENUCHAR                       = 0x0120;
    public const WM_ENTERIDLE                      = 0x0121;
    public const WM_MENURBUTTONUP                  = 0x0122;
    public const WM_MENUDRAG                       = 0x0123;
    public const WM_MENUGETOBJECT                  = 0x0124;
    public const WM_UNINITMENUPOPUP                = 0x0125;
    public const WM_MENUCOMMAND                    = 0x0126;
    public const WM_CHANGEUISTATE                  = 0x0127;
    public const WM_UPDATEUISTATE                  = 0x0128;
    public const WM_QUERYUISTATE                   = 0x0129;
    public const WM_CTLCOLORMSGBOX                 = 0x0132;
    public const WM_CTLCOLOREDIT                   = 0x0133;
    public const WM_CTLCOLORLISTBOX                = 0x0134;
    public const WM_CTLCOLORBTN                    = 0x0135;
    public const WM_CTLCOLORDLG                    = 0x0136;
    public const WM_CTLCOLORSCROLLBAR              = 0x0137;
    public const WM_CTLCOLORSTATIC                 = 0x0138;
    public const WM_MOUSEMOVE                      = 0x0200;
    public const WM_LBUTTONDOWN                    = 0x0201;
    public const WM_LBUTTONUP                      = 0x0202;
    public const WM_LBUTTONDBLCLK                  = 0x0203;
    public const WM_RBUTTONDOWN                    = 0x0204;
    public const WM_RBUTTONUP                      = 0x0205;
    public const WM_RBUTTONDBLCLK                  = 0x0206;
    public const WM_MBUTTONDOWN                    = 0x0207;
    public const WM_MBUTTONUP                      = 0x0208;
    public const WM_MBUTTONDBLCLK                  = 0x0209;
    public const WM_MOUSEWHEEL                     = 0x020A;
    public const WM_XBUTTONDOWN                    = 0x020B;
    public const WM_XBUTTONUP                      = 0x020C;
    public const WM_XBUTTONDBLCLK                  = 0x020D;
    public const WM_MOUSEHWHEEL                    = 0x020E;
    public const WM_PARENTNOTIFY                   = 0x0210;
    public const WM_ENTERMENULOOP                  = 0x0211;
    public const WM_EXITMENULOOP                   = 0x0212;
    public const WM_NEXTMENU                       = 0x0213;
    public const WM_SIZING                         = 0x0214;
    public const WM_CAPTURECHANGED                 = 0x0215;
    public const WM_MOVING                         = 0x0216;
    public const WM_POWERBROADCAST                 = 0x0218;
    public const WM_DEVICECHANGE                   = 0x0219;
    public const WM_MDICREATE                      = 0x0220;
    public const WM_MDIDESTROY                     = 0x0221;
    public const WM_MDIACTIVATE                    = 0x0222;
    public const WM_MDIRESTORE                     = 0x0223;
    public const WM_MDINEXT                        = 0x0224;
    public const WM_MDIMAXIMIZE                    = 0x0225;
    public const WM_MDITILE                        = 0x0226;
    public const WM_MDICASCADE                     = 0x0227;
    public const WM_MDIICONARRANGE                 = 0x0228;
    public const WM_MDIGETACTIVE                   = 0x0229;
    public const WM_MDISETMENU                     = 0x0230;
    public const WM_ENTERSIZEMOVE                  = 0x0231;
    public const WM_EXITSIZEMOVE                   = 0x0232;
    public const WM_DROPFILES                      = 0x0233;
    public const WM_MDIREFRESHMENU                 = 0x0234;
    public const WM_POINTERDEVICECHANGE            = 0x238;
    public const WM_POINTERDEVICEINRANGE           = 0x239;
    public const WM_POINTERDEVICEOUTOFRANGE        = 0x23A;
    public const WM_TOUCH                          = 0x0240;
    public const WM_NCPOINTERUPDATE                = 0x0241;
    public const WM_NCPOINTERDOWN                  = 0x0242;
    public const WM_NCPOINTERUP                    = 0x0243;
    public const WM_POINTERUPDATE                  = 0x0245;
    public const WM_POINTERDOWN                    = 0x0246;
    public const WM_POINTERUP                      = 0x0247;
    public const WM_POINTERENTER                   = 0x0249;
    public const WM_POINTERLEAVE                   = 0x024A;
    public const WM_POINTERACTIVATE                = 0x024B;
    public const WM_POINTERCAPTURECHANGED          = 0x024C;
    public const WM_TOUCHHITTESTING                = 0x024D;
    public const WM_POINTERWHEEL                   = 0x024E;
    public const WM_POINTERHWHEEL                  = 0x024F;
    public const WM_POINTERROUTEDTO                = 0x0251;
    public const WM_POINTERROUTEDAWAY              = 0x0252;
    public const WM_POINTERROUTEDRELEASED          = 0x0253;
    public const WM_IME_SETCONTEXT                 = 0x0281;
    public const WM_IME_NOTIFY                     = 0x0282;
    public const WM_IME_CONTROL                    = 0x0283;
    public const WM_IME_COMPOSITIONFULL            = 0x0284;
    public const WM_IME_SELECT                     = 0x0285;
    public const WM_IME_CHAR                       = 0x0286;
    public const WM_IME_REQUEST                    = 0x0288;
    public const WM_IME_KEYDOWN                    = 0x0290;
    public const WM_IME_KEYUP                      = 0x0291;
    public const WM_MOUSEHOVER                     = 0x02A1;
    public const WM_MOUSELEAVE                     = 0x02A3;
    public const WM_NCMOUSEHOVER                   = 0x02A0;
    public const WM_NCMOUSELEAVE                   = 0x02A2;
    public const WM_WTSSESSION_CHANGE              = 0x02B1;
    public const WM_DPICHANGED                     = 0x02E0;
    public const WM_DPICHANGED_BEFOREPARENT        = 0x02E2;
    public const WM_DPICHANGED_AFTERPARENT         = 0x02E3;
    public const WM_GETDPISCALEDSIZE               = 0x02E4;
    public const WM_CUT                            = 0x0300;
    public const WM_COPY                           = 0x0301;
    public const WM_PASTE                          = 0x0302;
    public const WM_CLEAR                          = 0x0303;
    public const WM_UNDO                           = 0x0304;
    public const WM_RENDERFORMAT                   = 0x0305;
    public const WM_RENDERALLFORMATS               = 0x0306;
    public const WM_DESTROYCLIPBOARD               = 0x0307;
    public const WM_DRAWCLIPBOARD                  = 0x0308;
    public const WM_PAINTCLIPBOARD                 = 0x0309;
    public const WM_VSCROLLCLIPBOARD               = 0x030A;
    public const WM_SIZECLIPBOARD                  = 0x030B;
    public const WM_ASKCBFORMATNAME                = 0x030C;
    public const WM_CHANGECBCHAIN                  = 0x030D;
    public const WM_HSCROLLCLIPBOARD               = 0x030E;
    public const WM_QUERYNEWPALETTE                = 0x030F;
    public const WM_PALETTEISCHANGING              = 0x0310;
    public const WM_PALETTECHANGED                 = 0x0311;
    public const WM_HOTKEY                         = 0x0312;
    public const WM_PRINT                          = 0x0317;
    public const WM_PRINTCLIENT                    = 0x0318;
    public const WM_APPCOMMAND                     = 0x0319;
    public const WM_THEMECHANGED                   = 0x031A;
    public const WM_CLIPBOARDUPDATE                = 0x031D;
    public const WM_DWMCOMPOSITIONCHANGED          = 0x031E;
    public const WM_DWMNCRENDERINGCHANGED          = 0x031F;
    public const WM_DWMCOLORIZATIONCOLORCHANGED    = 0x0320;
    public const WM_DWMWINDOWMAXIMIZEDCHANGE       = 0x0321;
    public const WM_DWMSENDICONICTHUMBNAIL         = 0x0323;
    public const WM_DWMSENDICONICLIVEPREVIEWBITMAP = 0x0326;
    public const WM_GETTITLEBARINFOEX              = 0x033F;
    public const WM_APP                            = 0x8000;
    public const WM_USER                           = 0x0400;
}
