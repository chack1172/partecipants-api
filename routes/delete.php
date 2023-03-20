<?php

use App\Application;
use App\Config;
use App\Resources\Partecipant;
use App\Utils\PartecipantCleaner;

require_once '../init.php';

$app->allowedMethods('DELETE');

$id = $_GET['id'] ?? null;
if (!$id) {
    return $app->response->error('Missing id', 400);
}

$sql = 'SELECT * FROM partecipants WHERE "_id" = :id;';
$stmt = $app->db->prepare($sql);
$stmt->execute(['id' => $id]);
$partecipant = $stmt->fetchObject();

$cleaner = new PartecipantCleaner();
if ($partecipant->has_image) {
    $partecipant->cleanImages($partecipant->image_path);
}
if ($partecipant->has_audio) {
    unlink(Config::AUDIO_PATH . $partecipant->audio_path);
}

$sql = 'DELETE FROM partecipants WHERE "_id" = :id;';
$stmt = $app->db->prepare($sql);
$stmt->execute(['id' => $id]);

$app->response->status(204)->send('');
