<?php
require_once 'config.php';
session_start();

if (isset($_POST['register'])) {
    $username = strtolower(trim($_POST['username']));
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $password = password_hash($password, PASSWORD_BCRYPT);

    require_once '../pdo/connection.php';

    $query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $response = $stmt->execute();

    if ($response === true) {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'af2a20736cc551';                 // SMTP username
            $mail->Password = 'c617b024b04e5e';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;

            $mail->setFrom('hello@ss-php.sumon', 'SS PHP 01');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Account created as '.$username;
            $mail->Body = 'Dear '.$email.',<br/>';
            $mail->Body .= 'Your account created successfully!';
            $mail->send();
        } catch (Exception $e) {
        }

        $_SESSION['message'] = 'User account created successfully!';
        header('Location: index.php');
        exit();
    }

    $_SESSION['message'] = 'Something went wrong! Please try again.';
    header('Location: index.php');
    exit();
}
