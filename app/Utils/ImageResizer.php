<?php

namespace App\Utils;

class ImageResizer
{
    public function resize(string $path, string $outputPath, int $maxWidth, int $maxHeight)
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // create an image resource from the original image file
        if ($extension == 'jpg' || $extension == 'jpeg') {
            $image = imagecreatefromjpeg($path);
        } elseif ($extension == 'png') {
            $image = imagecreatefrompng($path);
        } else {
            die('Unsupported image format');
        }

        // get the current width and height of the original image
        $width = imagesx($image);
        $height = imagesy($image);

        // calculate the new width and height while maintaining aspect ratio
        $ratio = min($maxWidth / $width, $maxHeight / $height);
        $newWidth = round($ratio * $width);
        $newHeight = round($ratio * $height);

        // create a new blank image with the new width and height
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // copy and resize the original image onto the new image
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // save the resized image as a new file
        if ($extension == 'jpg' || $extension == 'jpeg') {
            imagejpeg($newImage, $outputPath);
        } elseif ($extension == 'png') {
            imagepng($newImage, $outputPath);
        }

        // clean up the resources
        imagedestroy($image);
        imagedestroy($newImage);
    }
}
