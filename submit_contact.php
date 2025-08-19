<?php
require_once __DIR__. '/email/send_email.php';  

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? 'Guest';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Email to Admin
    $ownerSubject = "New Contact Message from $name";
    $ownerBody = "
        <h3>New Message from $name</h3>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    // Optional Email to Client
    $clientSubject = "We've received your message!";
    $clientBody = "
        <h3>Hello $name,</h3>
        <p>Thank you for contacting NewDay Marketing Solutions.</p>
        <p>We’ve received your message and will get back to you shortly.</p>
        <p><em>Your message:</em><br>$message</p>
        <br>
        <p>- NewDay Marketing Solutions</p>
    ";

    // Send emails
    sendEmail("sharononea29@gmail.com", $ownerSubject, $ownerBody);
    sendEmail($email, $clientSubject, $clientBody);

    header("Location: ../frontend/thankyou.html");
    exit();
}
?>