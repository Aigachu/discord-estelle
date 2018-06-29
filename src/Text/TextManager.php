<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Text;

use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class TextConstants
 * @package Aigachu\Lavenza\Text
 */
final class TextManager extends TextLibrary
{
    // Define this class as a Singleton.
    use SingletonTrait;

    /**
     * @param $constant
     * @param $placeholder_values
     * @return mixed
     */
    public static function get($constant, $placeholder_values) {
        $text = constant("self::$constant");

        if (!empty($placeholder_values)) {
            self::assignPlaceholderValuesToText($text, $placeholder_values);
        }

        return $text;
    }

    /**
     * @param $text
     * @param $placeholder_values
     */
    public static function assignPlaceholderValuesToText(&$text, $placeholder_values) {
        foreach ($placeholder_values as $i => $placeholder_value) {
            $i++;
            $text = str_replace("@$i", $placeholder_value, $text);
        }
    }
}