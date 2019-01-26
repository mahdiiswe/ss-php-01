<?php

require_once 'connection.php';

$email = 'sumon@gmail.com';

$query = 'SELECT * FROM users';
$stmt = $db->prepare($query);
$stmt->execute();

$data = $stmt->fetchAll();
?>

<table border="1">
    <thead>
    <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Email</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
