<?php

use App\Application;
use App\Resources\Partecipant;

require_once '../init.php';

$app->allowedMethods('POST');

$id = $_GET['id'] ?? null;
if (!$id) {
    return $app->response->error('Missing id', 400);
}

$data = [
    '_id' => $id,
    'name' => $_POST['name'] ?? '',
    'active' => !!($_POST['active'] ?? false),
    'has_audio' => !!($_POST['has_audio'] ?? false),
    'audio_path' => $_POST['audio_path'] ?? '',
    'has_image' => !!($_POST['has_image'] ?? false),
    'image_path' => $_POST['image_path'] ?? '',
];
$image = $_POST['image'] ?? null;
$audio = $_POST['audio'] ?? null;

if ($data['has_image'] && !empty($image)) {
    file_put_contents(ROOT . '/public/resources/images/' . $data['image_path'], base64_decode($image));
}
if ($data['has_audio'] && !empty($audio)) {
    file_put_contents(ROOT . '/public/resources/audio/' . $data['audio_path'], base64_decode($audio));
}


$sql = 'REPLACE INTO partecipants ("_id", "name", "active", "has_audio", "audio_path", "has_image", "image_path")
        VALUES (:_id, :name, :active, :has_audio, :audio_path, :has_image, :image_path);';
$stmt = $app->db->prepare($sql);
$stmt->execute($data);

$sql = 'SELECT * FROM partecipants WHERE "_id" = :id;';
$stmt = $app->db->prepare($sql);
$stmt->execute(['id' => $id]);
$partecipant = $stmt->fetchObject();

$app->response->status(200)->json(new Partecipant($partecipant));
