<?php
require_once 'config.php';

if (! isset($_SESSION['id'], $_SESSION['email'])) {
    $_SESSION['message'] = 'You need to login to access this page.';
    header('Location: login.php');
    exit();
}

$id = (int) $_SESSION['id'];
$query = 'SELECT profile_photo, address FROM users WHERE id=:id';
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch();

if (isset($_POST['update'])) {
    $profile_photo = $_FILES['profile_photo'];
    $address = trim($_POST['address']);
    $file_name = $user['profile_photo'];

    if (! empty($_FILES['profile_photo']['tmp_name'])) {
        $old_file = 'uploads/pp/'.$file_name;
        $file = uniqid('pp_', true);
        $name_parts = explode('.', $_FILES['profile_photo']['name']);
        $extension = end($name_parts);
        $file_name = $file.'.'.$extension;
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], 'uploads/pp/'.$file_name);
        unlink($old_file);
    }

    $query = 'UPDATE users SET profile_photo=:profile_photo, address=:address WHERE id=:id';
    $stmt = $db->prepare($query);
    $stmt->bindParam('profile_photo', $file_name);
    $stmt->bindParam('address', $address);
    $stmt->bindParam('id', $id);
    $stmt->execute();

    $_SESSION['message'] = 'Your profile updated.';
    header('Location: edit_profile.php');
    exit();
}
