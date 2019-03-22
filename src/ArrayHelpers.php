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
    public static function pickColumn(array $table, $column): array
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
    public static function pick(array $keys, array $subject): array
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
    public static function map(array $arr, $callback): array
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
     * @return float
     */
    public static function average(array $arr, $key = null): float
    {
        if ($key) {
            $values = static::pickColumn($arr, $key);
        } else {
            $values = $arr;
        }

        return floatval(array_sum($values) / count($values));
    }

    /**
     * Maps an array of classes instances to the values returned
     * by calling the specified method on each of the objects.
     *
     * @param object[] $arr Array of class instances
     * @param string $methodName Method to call on the object
     * @param array $methodArguments Method call arguments
     * @param string|null $validateClassName If set then each object will be ensured to be an instance of the specified class
     * @return array
     */
    public static function mapMethod(array $arr, string $methodName, array $methodArguments = [], string $validateClassName = null): array
    {
        return array_map(function($object) use ($methodName, $methodArguments, $validateClassName) {
            if ($validateClassName && !is_a($object, $validateClassName)) {
                throw new \InvalidArgumentException(sprintf('Expected object of class "%s", but got "%s"', $validateClassName, get_class($object)));
            }

            return $object->{$methodName}(...$methodArguments);
        }, $arr);
    }

    /**
     * array_uniqe() for arrays of objects
     *
     * Preserves keys and order (last instance is kept).
     *
     * @param object[] $arr
     * @return array
     */
    public static function uniqueObjects(array $arr): array
    {
        $uniqueKeys = [];

        foreach ($arr as $key => $obj) {
            $hash = spl_object_hash($obj);

            if (isset($uniqueKeys[$hash])) {
                continue;
            }

            $uniqueKeys[$hash] = $key;
        }

        return array_combine(
            $uniqueKeys,
            array_map(
                function($key) use ($arr) {
                    return $arr[$key];
                },
                $uniqueKeys
            )
        );
    }
}
