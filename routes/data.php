<?php

use App\Resources\Partecipant;

require_once '../init.php';

$app->allowedMethods('GET');

$sql = 'SELECT * from partecipants;';
$result = $app->db->query($sql);

$data = [];
foreach ($result->fetchAll(PDO::FETCH_OBJ) as $row) {
    $data[$row->_id] = new Partecipant($row);
}

$app->response->json($data);
