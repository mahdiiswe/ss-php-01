<?php
session_start();

if (isset($_POST['register'])) {
    $username = strtolower(trim($_POST['username']));
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_BCRYPT);

    require_once '../pdo/connection.php';

    $query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $response = $stmt->execute();

    if ($response === true) {
        $_SESSION['message'] = 'User account created successfully!';
        header('Location: index.php');
        exit();
    }

    $_SESSION['message'] = 'Something went wrong! Please try again.';
    header('Location: index.php');
    exit();
}
