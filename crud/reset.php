<?php
require_once 'config.php';

if (isset($_SESSION['id'], $_SESSION['email'])) {
    header('Location: dashboard.php');
    exit();
}

$token = trim($_GET['token']);
$query = 'SELECT email FROM password_resets WHERE token=:token';
$stmt = $db->prepare($query);
$stmt->bindParam(':token', $token);
$stmt->execute();

$user = $stmt->fetch();

if ($user === false) {
    $_SESSION['message'] = 'Invalid token.';
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

    <form action="resetpassword.php" method="post">
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $user['email']; ?>" required readonly>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
        </div>

        <button type="submit" name="reset" class="btn btn-primary">Set Password</button>
    </form>
</div>
</body>
</html>
