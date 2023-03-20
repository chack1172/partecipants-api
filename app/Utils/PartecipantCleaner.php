<?php

namespace App\Utils;

use App\Config;

class PartecipantCleaner
{
    public function __construct()
    {
        //
    }

    public function cleanImages(string $imagePath, bool $keepOriginal = false)
    {
        $dir = Config::IMAGES_PATH;
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            if (is_dir($dir . '/' . $file) && file_exists($dir . '/' . $file . '/' . $imagePath)) {
                unlink($dir . '/' . $file . '/' . $imagePath);
            }
        }

        if (!$keepOriginal) {
            unlink($dir . '/' . $imagePath);
        }
    }
}
