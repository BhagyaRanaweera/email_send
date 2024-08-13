<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = 2; 
$mail->SMTPDebug = 2;                   // Enable verbose debug output
$mail->isSMTP();                        // Set mailer to use SMTP
$mail->Host       = 'smtp.gfg.com;';    // Specify main SMTP server
$mail->SMTPAuth   = true;               // Enable SMTP authentication
$mail->Username   = 'user@gfg.com';     // SMTP username
$mail->Password   = 'password';         // SMTP password
$mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
$mail->Port       = 587;                // TCP port to           
$mail->setFrom('from@gfg.com', 'Name');           // Set sender of the mail
$mail->addAddress('receiver1@gfg.net');           // Add a recipient
$mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Subject of the email';
    $mail->Body    = 'This is the HTML message body';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="Styles.css">
    <style>
        .add-doctor-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-left: 300px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #007BFF;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.add-doctor-form');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirm-password');
            const emailField = document.getElementById('email');
            const doctorNameField = document.getElementById('doctor-name');
            const charCountDisplay = document.createElement('span');
            charCountDisplay.id = 'char-count';
            doctorNameField.parentNode.appendChild(charCountDisplay);

            // Validate that the passwords match
            form.addEventListener('submit', function(event) {
                if (passwordField.value !== confirmPasswordField.value) {
                    event.preventDefault();
                    alert('Passwords do not match. Please try again.');
                    return false;
                }

                if (!validateEmail(emailField.value)) {
                    event.preventDefault();
                    alert('Invalid email format. Please try again.');
                    return false;
                }
            });

            // Auto-focus the first input field
            doctorNameField.focus();

            // Display character count for doctor name
            doctorNameField.addEventListener('input', function() {
                const charCount = doctorNameField.value.length;
                charCountDisplay.textContent = `Character count: ${charCount}`;
            });

            // Email format validation
            function validateEmail(email) {
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return emailPattern.test(email);
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="images/Hospital.png" alt="Hospital Logo">
                <h1>Kings Hospital &rarr;</h1><h4> Admin panel</h4>
            </div>
            <div class="logout">
                <form action="admin.php" method="POST">
                    <button type="submit" id="logoutButton" style="color: aliceblue;">Logout</button>
                </form>
            </div>
        </header>
        <div class="content">
            <aside class="sidebar">
                <ul>
                    <li><a href="Dashboard.php" id="dashboardLink">Dashboard</a></li>
                    <li><a href="doctor_list.php" id="doctorListLink">Doctor List</a></li>
                    <li><a href="patient_list.php" id="patientListLink">Patient List</a></li>
                    <li><a href="appointment_details.php" id="appointmentDetailsLink">Appointment Details</a></li>
                    <li><a href="add_doctor.php" id="addDoctorLink">Add Doctor</a></li>
                    <li><a href="message.php" id="messagesLink">Messages</a></li>
                </ul>
            </aside>
            <main>
                <h2>WELCOME ADMIN</h2>
                <form class="add-doctor-form" action="add_doctor.php" method="POST">
                    <div class="form-group">
                        <label for="doctor-name">Doctor Name:</label>
                        <input type="text" id="doctor-name" name="doctor-name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email ID:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="consultancy-fees">Consultancy Fees:</label>
                        <input type="number" id="consultancy-fees" name="consultancy-fees" required>
                    </div>
                    <button type="submit">Add Doctor</button>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
