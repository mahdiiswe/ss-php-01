<?php
require_once 'config.php';

if (! isset($_SESSION['id'], $_SESSION['email'])) {
    $_SESSION['message'] = 'You need to login to access this page.';
    header('Location: login.php');
    exit();
}

$message = $_SESSION['message'] ?? null;
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
    </div>

    <div>
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form action="update_password.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input id="current_password" type="password" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input id="new_password" type="password" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password</label>
                <input id="confirm_new_password" type="password" name="confirm_new_password" class="form-control" required>
            </div>

            <button type="submit" name="change" class="btn btn-success">Change Password</button>
        </form>
    </div>

    <br/>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>

