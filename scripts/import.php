<?php
require_once '../init.php';

$data = json_decode(file_get_contents(ROOT . '/storage/partecipants.json'));

$sql = 'REPLACE INTO partecipants ("_id", "name", "active", "has_audio", "audio_path", "has_image", "image_path")
VALUES (:_id, :name, :active, :has_audio, :audio_path, :has_image, :image_path);';
foreach ($data as $p) {
    $p->image_path = $p->image_path ?? '';
    $p->audio_path = $p->audio_path ?? '';
    if ($p->has_image && str_starts_with($p->image_path, 'user://')) {
        $p->image_path = basename($p->image_path);
    }
    if ($p->has_audio && str_starts_with($p->audio_path, 'user://')) {
        $p->audio_path = basename($p->audio_path);
    }

    $stmt = $app->db->prepare($sql);
    $stmt->execute((array) $p);
}
