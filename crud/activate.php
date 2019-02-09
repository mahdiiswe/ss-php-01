<?php
require_once 'config.php';

$token = trim($_GET['token']);

$query = 'SELECT COUNT(id) as count FROM users WHERE activation_token = :token';
$stmt = $db->prepare($query);
$stmt->bindParam(':token', $token);
$stmt->execute();

$result = $stmt->fetch();
$user_exists = $result['count'];

if ((bool) $user_exists === true) {
    $query = 'UPDATE users SET active=1, activation_token=null WHERE activation_token = :token';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    $_SESSION['message'] = 'Account activated! You can login now.';
    header('Location: login.php');
    exit();
}

$_SESSION['message'] = 'Invalid token!';
header('Location: index.php');
exit();
