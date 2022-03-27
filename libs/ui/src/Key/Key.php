<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Ui\Key;

use Bic\Contracts\Ui\Key\KeyInterface;

enum Key: int implements KeyInterface
{
    case BACKSPACE = 8;
    case TAB = 9;
    case ENTER = 13;
    case SHIFT = 16;
    case CTRL = 17;
    case ALT = 18;
    case PAUSE_BREAK = 19;
    case CAPS_LOCK = 20;
    case ESCAPE = 27;
    case SPACE = 32;
    case PAGE_UP = 33;
    case PAGE_DOWN = 34;
    case END = 35;
    case HOME = 36;
    case LEFT = 37;
    case UP = 38;
    case RIGHT = 39;
    case DOWN = 40;
    case INSERT = 45;
    case DELETE = 46;
    case KB_0 = 48;
    case KB_1 = 49;
    case KB_2 = 50;
    case KB_3 = 51;
    case KB_4 = 52;
    case KB_5 = 53;
    case KB_6 = 54;
    case KB_7 = 55;
    case KB_8 = 56;
    case KB_9 = 57;
    case KB_A = 65;
    case KB_B = 66;
    case KB_C = 67;
    case KB_D = 68;
    case KB_E = 69;
    case KB_F = 70;
    case KB_G = 71;
    case KB_H = 72;
    case KB_I = 73;
    case KB_J = 74;
    case KB_K = 75;
    case KB_L = 76;
    case KB_M = 77;
    case KB_N = 78;
    case KB_O = 79;
    case KB_P = 80;
    case KB_Q = 81;
    case KB_R = 82;
    case KB_S = 83;
    case KB_T = 84;
    case KB_U = 85;
    case KB_V = 86;
    case KB_W = 87;
    case KB_X = 88;
    case KB_Y = 89;
    case KB_Z = 90;
    case LWIN = 91;
    case RWIN = 92;
    case MENU = 93;
    case NUM_0 = 96;
    case NUM_1 = 97;
    case NUM_2 = 98;
    case NUM_3 = 99;
    case NUM_4 = 100;
    case NUM_5 = 101;
    case NUM_6 = 102;
    case NUM_7 = 103;
    case NUM_8 = 104;
    case NUM_9 = 105;
    case MULTIPLY = 106;
    case ADD = 107;
    case SUBTRACT = 109;
    case DECIMAL = 110;
    case DIVIDE = 111;
    case F1 = 112;
    case F2 = 113;
    case F3 = 114;
    case F4 = 115;
    case F5 = 116;
    case F6 = 117;
    case F7 = 118;
    case F8 = 119;
    case F9 = 120;
    case F10 = 121;
    case F11 = 122;
    case F12 = 123;
    case NUM_LOCK = 144;
    case SCROLL_LOCK = 145;
    case SEMI_COLON = 186;
    case EQUAL_SIGN = 187;
    case COMMA = 188;
    case DASH = 189;
    case PERIOD = 190;
    case SLASH = 191;
    case GRAVE_ACCENT = 192;
    case LEFT_BRACKET = 219;
    case BACKSLASH = 220;
    case RIGHT_BRACKET = 221;
    case SINGLE_QUOTE = 222;

    /**
     * @param positive-int|0 $code
     * @return KeyInterface
     */
    public static function create(int $code): KeyInterface
    {
        return self::tryFrom($code) ?? new UserKey($code);
    }

    /**
     * {@inheritDoc}
     */
    public function getCode(): int
    {
        return $this->value;
    }
}
