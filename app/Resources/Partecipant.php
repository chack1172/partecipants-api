<?php

namespace App\Resources;

use App\Config;

class Partecipant extends Resource
{
    public function toArray(): array
    {
        if ($this->has_image) {
            $image = base64_encode(file_get_contents(Config::IMAGES_PATH . $this->image_path));
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
