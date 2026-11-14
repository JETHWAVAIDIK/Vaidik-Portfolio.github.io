<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {

  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
  $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
  $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
  $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

  $mail = new PHPMailer(true);
  try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yourgmail@gmail.com'; // your Gmail
    $mail->Password   = 'your_app_password'; // App password, not Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('jethwavaidik@gmail.com', 'Vaidik');

    // Content
    $mail->Subject = $subject;
    $mail->Body    = "From: $name <$email>\n\n$message";

    $mail->send();
    echo 'Message sent successfully!';
  } catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
  }
} else {
  echo 'Error: All fields are required.';
}
