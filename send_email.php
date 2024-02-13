<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Recipient email address
    $to = 'saleem.s@bgtsol.com';
    
    // Subject
    $subject = 'Message from ' . $name;
    
    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message:\n$message\n";
    
    // SMTP server configuration
    $smtpHost = 'smtp.gmail.com';
    $smtpPort = 587; // TLS port
    $smtpUsername = 'saleem.s@bgtsol.com';
    $smtpPassword = 'xvqm ngpb njcg xmlh'; // Your Gmail password or App Password
    
    // Create PHPMailer object
    $mail = new PHPMailer(true);
    
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        // $mail->SMTPSecure = 'tls';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtpPort;
        
        // Sender and recipient
        $mail->setFrom($smtpUsername, $name);
        $mail->addAddress($to);
        
        // Email content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $email_content;

        // Add custom header: MIME-Version
        $mail->addCustomHeader('MIME-Version', '1.0');  

        // Set content type
        $mail->ContentType = 'text/html; charset=UTF-8';    
        
        // Send email
        $mail->send();
        echo '<p>Your message has been sent successfully. Thank you!</p>';
    } catch (Exception $e) {
        echo '<p>Oops! Something went wrong. Please try again later.</p>';
        echo 'Error: ' . $mail->ErrorInfo;
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: contact.html");
    exit;
}
?>
