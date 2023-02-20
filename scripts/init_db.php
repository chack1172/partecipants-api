<?php

require_once '../init.php';

$schema = file_get_contents(ROOT . '/storage/schema.sql');
$app->db->exec($schema);
