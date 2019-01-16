<?php

namespace Creativestyle\Utilities;

class ArrayHelpers
{
    /**
     * Picks column from array of arrays which form a table-like structure.
     *
     * @param array $table
     * @param string $column
     * @return array
     */
    public static function pickColumn(array $table, $column)
    {
        return array_map(function(array $row) use ($column) {
            return isset($row[$column]) ? $row[$column] : null;
        }, $table);
    }

    /**
     * Picks element from array by keys.
     *
     * @param array $keys
     * @param array $subject
     *
     * @return array
     */
    public static function pick(array $keys, array $subject)
    {
        $result = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $subject)) {
                $result[$key] = $subject[$key];
            }
        }

        return $result;
    }

    /**
     * Maps the array allowing you to change the keys
     *
     * Callback is called with ($key, $value) parameters and shall return
     * a [$newkey => $newvalue] array.
     *
     * @param array $arr
     * @param callable $callback
     * @return array
     */
    public static function map(array $arr, $callback)
    {
        $result = [];

        foreach ($arr as $k => $v) {
            foreach ($callback($k, $v) as $nk => $nv) {
                $result[$nk] = $nv;
            }
        }

        return $result;
    }

    /**
     * Returns average value
     *
     * If key is set then the column indicated by key is averaged.
     *
     * @param array $arr
     * @param null $key
     *
     * @return float|int
     */
    public static function average(array $arr, $key = null)
    {
        if ($key) {
            $values = static::pickColumn($arr, $key);
        } else {
            $values = $arr;
        }

        return array_sum($values) / count($values);
    }
}
