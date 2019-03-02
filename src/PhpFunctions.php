<?php
declare(strict_types=1);

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2019 BuzzingPixel, LLC
 * @license Apache-2.0
 */

namespace corbomite\migrations;

class PhpFunctions
{
    public function fileExists(string $filename): bool
    {
        return file_exists($filename);
    }

    public function copy(string $source, string $dest, $context = null): bool
    {
        return copy($source, $dest, $context);
    }
}
