<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
$servername = "localhost";
$username = "root";
$password = "Lawanya@1117";
$database = "faculty_register_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $category = $_POST["cast"];
    $password = $_POST["password"];
    $re_password = $_POST["re_password"];

    // Perform validation
    $errors = [];

    // Validate first name
    if (empty($firstname)) {
        $errors[] = "First name is required";
    }

    // Validate last name
    if (empty($lastname)) {
        $errors[] = "Last name is required";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    } elseif ($password !== $re_password) {
        $errors[] = "Passwords do not match";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Insert data into database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO faculty (firstname, lastname, email, category, password) VALUES ('$firstname', '$lastname', '$email', '$category', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Send activation email
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'haswanthi.gv7@gmail.com'; // Your Gmail email address
                $mail->Password   = 'Hwt@1117';        // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('your_email@gmail.com', 'Your Name');
                $mail->addAddress($email);     // Add recipient email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Account Activation';
                $mail->Body    = "Click the link below to activate your account:<br><br>http://yourwebsite.com/activate.php?email=" . urlencode($email);

                $mail->send();
                echo "Account created successfully. Please check your email to activate your account.";
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    // If the request method is not POST, redirect the user to the form page
    header("Location: your-form-page.html");
    exit();
}

$conn->close();
?>
