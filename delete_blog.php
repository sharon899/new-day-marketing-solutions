<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $conn = new mysqli("localhost", "root", "", "newday_solutions", 4306);
  if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

  $id = intval($_GET['id']);
  $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: admin_blog.php");
    exit();
  } else {
    echo "Error deleting blog.";
  }

  $stmt->close();
  $conn->close();
} else {
  echo "Invalid blog ID.";
}
?>