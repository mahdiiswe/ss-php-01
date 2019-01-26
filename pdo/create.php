<?php

require_once 'connection.php';

$username = 'sumonselim';
$password = '123456';
$email = 'sumon@gmail.com';

$query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':email', $email);
$stmt->execute();
