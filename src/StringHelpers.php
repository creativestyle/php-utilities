<?php

namespace Creativestyle\Utilities;

class StringHelpers
{
    const TRANSLITERATOR_ID = 'Any-Latin; Latin-ASCII';

    /**
     * @var \Transliterator
     */
    protected static $transliterator = null;

    /**
     * @return \Transliterator
     */
    protected static function getTransliterator()
    {
        if (null === self::$transliterator) {
            self::$transliterator = \Transliterator::create(self::TRANSLITERATOR_ID);
        }

        return self::$transliterator;
    }

    /**
     * Slugifies the text, so it can be used as part of an url.
     *
     * @param $text
     * @return string
     */
    public static function urlize($text)
    {
        if (empty($text)) {
            return '';
        }

        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = self::getTransliterator()->transliterate($text);
        $text = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }

    /**
     * Joins elements ignoring empty ones.
     *
     * @param string $delimiter
     * @param array $elements
     * @return string
     */
    public static function joinNotEmpty(array $elements, $delimiter = ', ')
    {
        $filtered = array_filter($elements, function($element) {
            return !empty($element);
        });

        if (empty($filtered)) {
            return '';
        }

        return implode($delimiter, $filtered);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        $ldiff = strlen($haystack) - strlen($needle);

        if ($ldiff < 0) {
            return false;
        }

        return strpos($haystack, $needle, $ldiff) === $ldiff;
    }

    /**
     * @param $string
     * @return string
     */
    public static function convertToTitleCase($string)
    {
        return mb_convert_case(mb_strtolower($string, "UTF-8"), MB_CASE_TITLE, "UTF-8");
    }

    /**
     * Humanizes a camelcase string.
     *
     * @param string $text
     * @return string
     */
    public static function humanize($text)
    {
        return ucfirst(strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $text)));
    }

    /**
     * @param string $constName
     * @return string
     */
    public static function humanizeConst($constName)
    {
        return mb_convert_case(str_replace('_', ' ', $constName), MB_CASE_TITLE);
    }

    /**
     * Checks whether value can be converted to string.
     *
     * @param mixed $value
     * @return bool
     */
    public static function isCoercibleToString($value)
    {
        if (is_scalar($value)) {
            return true;
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return true;
        }

        return false;
    }
}