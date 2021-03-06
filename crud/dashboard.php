<?php
require_once 'config.php';

if (! isset($_SESSION['id'], $_SESSION['email'])) {
    $_SESSION['message'] = 'You need to login to access this page.';
    header('Location: login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SS PHP CRUD</title>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="alert alert-info">
        You have been logged in as, <?php echo $_SESSION['email']; ?>
        (<?php echo $_SESSION['role']; ?>)
    </div>

    <div>
        <p>
            <a href="edit_profile.php">
                Edit Profile
            </a>
        </p>
        <p>
            <a href="change_password.php">
                Change Password
            </a>
        </p>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <p>
                <a href="users.php">
                    Users
                </a>
            </p>
        <?php endif; ?>
    </div>

    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
