<?php

require_once 'connection.php';

$id = 3;
$username = 'foysal123';
$email = 'foysal@gmail.com';

$query = 'UPDATE users SET username=:username, email=:email WHERE id=:id';
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

echo $stmt->rowCount();
