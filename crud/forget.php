<?php
require_once 'config.php';

if (isset($_SESSION['id'], $_SESSION['email'])) {
    header('Location: dashboard.php');
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

    <form action="forgetemail.php" method="post">
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" required>
        </div>

        <button type="submit" name="forget" class="btn btn-primary">Reset Password</button>

        <p></p>

        <p>
        <a href="login.php" class="btn btn-info">
            Login
        </a>
        </p>
    </form>
</div>
</body>
</html>
