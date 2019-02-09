<?php
require_once 'config.php';

if (! isset($_SESSION['id'], $_SESSION['email'])) {
    $_SESSION['message'] = 'You need to login to access this page.';
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = 'You need to admin role to access this page.';
    header('Location: dashboard.php');
    exit();
}

$query = "SELECT id,username,email,active FROM users WHERE role='user'";
$stmt = $db->prepare($query);
$stmt->execute();

$users = $stmt->fetchAll();
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
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Email</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo (int)$user['active'] === 1 ? 'Active' : 'Inactive'; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
