<?php
// contact_process.php

// Replace with your actual email address
$to = "info@example.com";
$subject = "Contact Us Form Submission";

// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Create email content
$email_body = "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n";
$email_body .= "Message:\n$message\n";

// Set email headers
$headers = "From: $email";

// Send email
if (mail($to, $subject, $email_body, $headers)) {
    echo "Thank you for contacting us! We will get back to you soon.";
} else {
    echo "There was a problem sending your message. Please try again later.";
}
?>
