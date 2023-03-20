<?php

namespace App\Resources;

use App\Config;
use App\Utils\ImageResizer;

class Partecipant extends Resource
{
    private $imageResizer;

    public function __construct(
        protected $data
    )
    {
        $this->imageResizer = new ImageResizer();
    }

    public function toArray(): array
    {
        if ($this->has_image) {
            $resizedFolder = Config::IMAGES_PATH . Config::IMAGE_WIDTH . 'x' . Config::IMAGE_HEIGHT . '/';
            $resizedImagePath = $resizedFolder . $this->image_path;
            if (!file_exists($resizedImagePath)) {
                $imagePath = Config::IMAGES_PATH . $this->image_path;
                if (!is_dir($resizedFolder)) {
                    mkdir($resizedFolder);
                }
                $this->imageResizer->resize($imagePath, $resizedImagePath, Config::IMAGE_WIDTH, Config::IMAGE_HEIGHT);
            }
            $image = base64_encode(file_get_contents($resizedImagePath));
        } else {
            $image = '';
        }

        if ($this->has_audio) {
            $audio = base64_encode(file_get_contents(Config::AUDIO_PATH . $this->audio_path));
        } else {
            $audio = '';
        }

        return array_merge(parent::toArray(), [
            'has_image' => (bool) $this->has_image,
            'has_audio' => (bool) $this->has_audio,
            'active' => (bool) $this->active,
            'image' => $image,
            'audio' => $audio
        ]);
    }
}
