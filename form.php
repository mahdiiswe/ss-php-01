<?php
$success = null;

if (! empty($_FILES['photo']['tmp_name'])) {
    $file = uniqid('photo_', true);
    $name_parts = explode('.', $_FILES['photo']['name']);
    $extension = end($name_parts);
    $file_name = $file.'.'.$extension;

    move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/'.$file_name);
    $success = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>HTML Form</title>
</head>
<body>
<div class="container">
    <?php if (isset($success)): ?>
        <div class="alert alert-success">
            <p>File uploaded.</p>
            <img class="img img-responsive" src="photos/<?php echo $file_name; ?>" alt="photo" width="250">
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" name="photo" placeholder="Photo">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
