<?php
require_once 'email/send_email.php'; // Include your email function

$host = "localhost";
$user = "root";
$password = "";
$dbname = "newday_solutions";
$port = 4306;

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (
  isset($_POST['first_name']) &&
  isset($_POST['last_name']) &&
  isset($_POST['contact']) &&
  isset($_POST['email']) &&
  isset($_POST['service']) &&
  isset($_POST['date']) &&
  isset($_POST['time'])
) {
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $service = $_POST['service'];
  $date = $_POST['date'];
  $time = $_POST['time'];

  // Save to DB
  $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, contact, email, service, date, time)
                          VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $firstName, $lastName, $contact, $email, $service, $date, $time);

  if ($stmt->execute()) {
    // ✅ Send email to client
    $clientSubject = "Booking Confirmation - NewDay Marketing";
    $clientBody = "
      <h3>Hello $firstName,</h3>
      <p>Thank you for booking <strong>$service</strong> on <strong>$date</strong> at <strong>$time</strong>.</p>
      <p>We’ll get back to you shortly.</p>
      <br>
      <p>– NewDay Marketing Solutions</p>
    ";

    // ✅ Send email to owner
    $ownerSubject = "New Booking from $firstName $lastName";
    $ownerBody = "
      <h3>New Booking Received</h3>
      <p><strong>Client Name:</strong> $firstName $lastName</p>
      <p><strong>Email:</strong> $email</p>
      <p><strong>Contact:</strong> $contact</p>
      <p><strong>Service:</strong> $service</p>
      <p><strong>Date:</strong> $date</p>
      <p><strong>Time:</strong> $time</p>
    ";

    sendEmail($email, $clientSubject, $clientBody); // to client
    sendEmail("sharononea29@gmail.com", $ownerSubject, $ownerBody); // to admin

    header("Location: ../frontend/thankyou.html");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Please fill all fields.";
}

$conn->close();
?>