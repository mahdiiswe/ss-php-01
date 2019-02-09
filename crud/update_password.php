<?php
require_once 'config.php';

if (! isset($_SESSION['id'], $_SESSION['email'])) {
    $_SESSION['message'] = 'You need to login to access this page.';
    header('Location: login.php');
    exit();
}

$id = (int) $_SESSION['id'];
if (isset($_POST['change'])) {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_new_password = trim($_POST['confirm_new_password']);

    $query = 'SELECT password FROM users WHERE id=:id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();

    if (password_verify($current_password, $user['password']) === true) {
        if ($new_password === $confirm_new_password) {
            $new_password = password_hash($new_password, PASSWORD_BCRYPT);

            $query = 'UPDATE users SET password=:password WHERE id=:id';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':password', $new_password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $_SESSION['message'] = 'Password changed!';
            header('Location: change_password.php');
            exit();
        }

        $_SESSION['message'] = 'New password and confirm new password does not match!';
        header('Location: change_password.php');
        exit();
    }

    $_SESSION['message'] = 'Invalid current password!';
    header('Location: change_password.php');
    exit();
}
