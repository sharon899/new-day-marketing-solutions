<?php
$to = "sharononea630@gmail.com";
$subject = "Test Email from XAMPP";
$message = "Congratulations! Your SMTP is working.";
$headers = "From: sharononea29@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
?>