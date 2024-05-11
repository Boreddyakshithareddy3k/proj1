<?php
    session_start();
    include('./mail/PHPMailer.php');
    include('./mail/SMTP.php');
    include('./mail/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    

    //Load Composer's autoloader
    // require 'vendor/autoload.php';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ronankiller1@gmail.com';                     //SMTP username
        $mail->Password   = 'lttbuuekmraubeco';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('ronankiller1@gmail.com', 'Mailer');
        $mail->addAddress("".$email, 'Receiver');     //Add a recipient
    
        
        //Content
        $mail->isHTML(true);                                 //Set email format to HTML
        $mail->Subject = 'Otp to reset password';
        $mail->Body    = $mail->Body = 'Your otp is <b>'. $_SESSION['otp'].'</b>';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?>