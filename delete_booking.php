<?php
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $conn = new mysqli("localhost", "root", "", "newday_solutions", 4306);
  if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $stmt->close();
  $conn->close();
}

header("Location: view_booking.php");
exit();
?>