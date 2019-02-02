<?php
session_start();

if (isset($_POST['login'])) {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    require_once '../pdo/connection.php';

    $query = 'SELECT id,password FROM users WHERE email=:email';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password']) === true) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $email;

            header('Location: dashboard.php');
            exit();
        }

        $_SESSION['message'] = 'Invalid credentials.';
        header('Location: login.php');
        exit();
    }

    $_SESSION['message'] = 'User not found.';
    header('Location: login.php');
    exit();
}
