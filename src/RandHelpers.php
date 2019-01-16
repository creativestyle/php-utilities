<?php

namespace Creativestyle\Utilities;

use RandomLib;

class RandHelpers
{
    /** @var RandomLib\Factory */
    private static $randFactory = null;

    /**
     * Random seed string
     *
     * @return string
     */
    public static function seed(): string
    {
        return floor(microtime(true) * 10000) . mt_rand();
    }

    /**
     * @param float $trueChance Float in range 0 - 1.0
     * @return bool
     */
    public static function randBool($trueChance)
    {
        return mt_rand() < ($trueChance * mt_getrandmax());
    }

    /**
     * @param array $array
     * @return mixed
     */
    public static function arrayRand(array $array)
    {
        if (empty($array)) {
            return null;
        }

        return $array[array_rand($array)];
    }

    /**
     * @param float $mu Mean
     * @param float $sigma Deviation
     * @return float
     */
    public static function gaussianRand($mu, $sigma)
    {
        $x = mt_rand() / mt_getrandmax();
        $y = mt_rand() / mt_getrandmax();
        return sqrt(-2 * log($x)) * cos(2 * pi() * $y) * $sigma + $mu;
    }


    /**
     * @param float $x
     * @param float $mu Mean
     * @param float $sigma Deviation
     * @return float
     */
    public static function normalProbabilityDensity($x, $mu, $sigma)
    {
        $sigma2 = $sigma * $sigma;

        return pow(M_E, -pow($x - $mu, 2) / (2 * $sigma2)) / (sqrt(2 * $sigma2 * M_PI));
    }

    /**
     * @return RandomLib\Factory
     */
    protected static function getRandFactory()
    {
        if (!self::$randFactory) {
            self::$randFactory = new RandomLib\Factory();
        }

        return self::$randFactory;
    }

    /**
     * @param int $length
     * @param string $chars
     * @return string
     */
    public static function randString($length = 12, $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        return self::getRandFactory()->getMediumStrengthGenerator()->generateString($length, $chars);
    }
}