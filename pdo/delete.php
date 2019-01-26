<?php

require_once 'connection.php';

$id = 3;

$query = 'DELETE FROM users WHERE id=:id';
$stmt = $db->prepare($query);
$stmt->execute([':id' => $id]);

echo $stmt->rowCount();
