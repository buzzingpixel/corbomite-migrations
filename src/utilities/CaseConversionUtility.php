<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

namespace corbomite\migrations\utilities;

class CaseConversionUtility
{
    public function convertStringToPascale(string $str): string
    {
        return $this->spaceConvert($this->underscoreConvert($str));
    }

    public function convertStringToCamel(string $str): string
    {
        return lcfirst($this->convertStringToPascale($str));
    }

    private function underscoreConvert(string $str): string
    {
        $finalStr = '';

        foreach (explode('_', $str) as $item) {
            $finalStr .= ucfirst($item);
        }

        return $finalStr;
    }

    private function spaceConvert(string $str): string
    {
        $finalStr = '';

        foreach (preg_split('/\s+/', $str) as $item) {
            $finalStr .= ucfirst($item);
        }

        return $finalStr;
    }
}
