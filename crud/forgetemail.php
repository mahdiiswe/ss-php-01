<?php
require_once 'config.php';

if (isset($_POST['forget'])) {
    $email = strtolower(trim($_POST['email']));

    $query = 'SELECT COUNT(id) as count FROM users WHERE email=:email';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch();
    $email_exists = $result['count'];

    if ((bool) $email_exists === true) {
        $token = sha1(md5($email.time().uniqid('', true)));

        $query = 'INSERT INTO password_resets (email, token) VALUES (:email, :token)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // send email
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'af2a20736cc551';                 // SMTP username
            $mail->Password = 'c617b024b04e5e';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('hello@ss-php.sumon', 'SS PHP 01');
            $mail->addAddress($email);

            //Content
            $mail->isHTML();                                  // Set email format to HTML
            $mail->Subject = 'Reset Password';
            $mail->Body .= 'Please click the following link to reset your password: <br/>';
            $mail->Body .= '
            <a href="http://ss-php.sumon/crud/reset.php?token='.$token.'">
            http://ss-php.sumon/crud/reset.php?token='.$token.'
            </a>';
            $mail->Body .= '<br/>';

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        $_SESSION['message'] = 'Please check your mail.';
        header('Location: login.php');
        exit();
    }
}
