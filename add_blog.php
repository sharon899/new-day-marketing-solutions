<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "newday_solutions", 4306);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['title']) && isset($_POST['content'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];

  $stmt = $conn->prepare("INSERT INTO blogs (title, content) VALUES (?, ?)");
  $stmt->bind_param("ss", $title, $content);

  if ($stmt->execute()) {
    header("Location: admin_blog.php");
    exit();
  } else {
    echo "Error posting blog: " . $stmt->error;
  }
} else {
  echo "Missing blog title or content.";
}
$conn->close();
?>