<?php
require_once __DIR__ . '/../backend/email/send_email.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $host = "127.0.0.1";
  $port = 4306;
  $username = "root";
  $password = "";
  $database = "newday_solutions";

  $conn = new mysqli($host, $username, $password, $database, $port);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $conn->real_escape_string($_POST["name"]);
  $email = $conn->real_escape_string($_POST["email"]);
  $phone = $conn->real_escape_string($_POST["phone"]);
  $message = $conn->real_escape_string($_POST["message"]);

  $sql = "INSERT INTO messages (name, email, phone, message, submitted_at) 
          VALUES ('$name', '$email', '$phone', '$message', NOW())";

  if ($conn->query($sql)) {
    // Email to Website Owner
    $ownerSubject = "📩 New Contact Message from $name";
    $ownerBody = "
      <h3>You’ve received a new message</h3>
      <p><strong>Name:</strong> $name</p>
      <p><strong>Email:</strong> $email</p>
      <p><strong>Phone:</strong> $phone</p>
      <p><strong>Message:</strong><br>$message</p>
    ";
    sendEmail("sharononea29@gmail.com", $ownerSubject, $ownerBody);

    // Email to User
    $clientSubject = "📬 Thank You for Contacting NewDay";
    $clientBody = "
      <h3>Hello $name,</h3>
      <p>Thanks for reaching out to NewDay Marketing Solutions.</p>
      <p>We’ve received your message and will get back to you shortly.</p>
      <p><em>Your message:</em><br>$message</p>
      <br>
      <p>— NewDay Marketing Solutions</p>
    ";
    sendEmail($email, $clientSubject, $clientBody);

    echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
  } else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact | NewDay</title>
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="icon" type="image/jpg" href="images/New-day-market-solution.jpeg" />
</head>
<body class="contact-page">

  <!-- Header -->
  <header>
    <div class="container header-flex">
      <img src="images/New-day-market-solution.jpeg" alt="NewDay Logo" class="logo-img rotating-logo" />
      <nav>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio_public.php">Portfolio</a></li>
          <li><a href="blogs_public.php">Blog</a></li>
          <li><a href="dashboard.html">Dashboard</a></li>
          <li><a href="contact.php" class="active">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero contact-hero">
    <div class="container">
      <h1>Contact Us</h1>
      <p>We're here to support your marketing growth. Get in touch!</p>
    </div>
  </section>

  <!-- Contact Form -->
  <section class="contact-main container">
    <div class="contact-form">
      <h2>Send Us a Message</h2>
      <form method="POST" action="contact.php">
        <label>Name<input type="text" name="name" required /></label>
        <label>Email<input type="email" name="email" required /></label>
        <label>Phone<input type="tel" name="phone" /></label>
        <label>Message<textarea name="message" rows="5" required></textarea></label>
        <button type="submit">Get In Touch</button>
      </form>
    </div>

    <div class="contact-info">
      <h2>Our Office</h2>
      <p><strong>Address:</strong> Lenana Rd, Nairobi, Kenya</p>
      <p><strong>Phone:</strong> +254708755860</p>
      <p><strong>Email:</strong> <a href="mailto:info@newdaymarketingltd.com">info@newdaymarketingltd.com</a></p>
      <p>Want to schedule a service directly?</p>
      <a href="booking.html" class="btn">Book a Service Now</a>
    </div>
  </section>

  <section class="phone-contact">
    <div class="container">
      <a href="tel:0708755860" class="phone-link">
        <img src="images/phone-icon.jpg" alt="Phone Icon" class="phone-icon" />
        <span>0708755860</span>
      </a>
    </div>
  </section>

  <div class="social-links">
    <h3>Connect with Us</h3>
    <p>Follow us for updates and support:</p>
    <ul class="social-list">
      <li><strong>Facebook:</strong> <a href="https://www.facebook.com/share/16jxeyUQea/" target="_blank">facebook.com/newdaymarketingsolutions</a></li>
      <li><strong>Instagram:</strong> <a href="https://www.instagram.com/newdaymarketingsolutions" target="_blank">instagram.com/newdaymarketingsolutions</a></li>
      <li><strong>WhatsApp:</strong> <a href="https://wa.me/message/OYTKY5HQ7G6YM1" target="_blank">Click to Chat</a></li>
    </ul>
  </div>

  <!-- Footer -->
    <footer class="contact-footer">
    <div class="container">
      <p>&copy; 2025 NewDay Marketing Solutions. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>