<?php

namespace App\Services;

class ImageService
{
    public function resizeImage($filePath, $maxDimension)
    {
        list($width, $height, $type) = getimagesize($filePath);
        $ratio = $width / $height;

        if ($width > $height) {
            $newWidth = $maxDimension;
            $newHeight = $maxDimension / $ratio;
        } else {
            $newHeight = $maxDimension;
            $newWidth = $maxDimension * $ratio;
        }

        $src = $this->createImageResource($filePath, $type);
        $dst = imagecreatetruecolor($newWidth, $newHeight);

        // Enable alpha blending for PNG images
        if ($type == IMAGETYPE_PNG) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Save the resized image back to the same path
        $this->saveImageResource($dst, $filePath, $type);

        // Free up memory
        imagedestroy($src);
        imagedestroy($dst);
    }

    private function createImageResource($filePath, $type)
    {
        switch ($type) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($filePath);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($filePath);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($filePath);
            default:
                throw new \Exception('Unsupported image type');
        }
    }

    private function saveImageResource($resource, $filePath, $type)
    {
        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($resource, $filePath, 90); // Scale 0 worst, 100 best.
                break;
            case IMAGETYPE_PNG:
                imagepng($resource, $filePath, 5); // Scale 0 best, 9 worst.
                break;
            case IMAGETYPE_GIF:
                imagegif($resource, $filePath);
                break;
            default:
                throw new \Exception('Unsupported image type');
        }
    }
}
