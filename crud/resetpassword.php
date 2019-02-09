<?php
require_once 'config.php';

if (isset($_POST['reset'])) {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_BCRYPT);

    $query = 'UPDATE users SET password = :password WHERE email = :email';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ((bool) $stmt->rowCount() === true) {
        $query = 'DELETE FROM password_resets WHERE email = :email';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $_SESSION['message'] = 'Password changed! You can login now.';
        header('Location: login.php');
        exit();
    }

    $_SESSION['message'] = 'Something went wrong! Please try again.';
    header('Location: index.php');
    exit();
}
