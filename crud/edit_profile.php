<?php
require_once 'config.php';

if (! isset($_SESSION['id'], $_SESSION['email'])) {
    $_SESSION['message'] = 'You need to login to access this page.';
    header('Location: login.php');
    exit();
}

$message = $_SESSION['message'] ?? null;
$id = (int) $_SESSION['id'];
$query = 'SELECT profile_photo, address FROM users WHERE id=:id';
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch();
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
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form action="update_profile.php" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="profile_photo">Profile Photo: </label>
                <input type="file" name="profile_photo" class="form-control">
                <?php if (! empty($user['profile_photo'])): ?>
                    <img src="uploads/pp/<?php echo $user['profile_photo']; ?>" alt="Profile Photo" width="150">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="address">Address: </label>
                <textarea class="form-control" name="address" id="address"><?php echo $user['address']; ?></textarea>
            </div>

            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    </div>

    <br/>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
