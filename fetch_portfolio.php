<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "newday_solutions";
$port = 4306;

$conn = new mysqli($host, $user, $password, $dbname, $port);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$portfolio = [];

$query = "SELECT image_path, project_title, description, created_at FROM portfolio ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result) {
  while ($row = $result->fetch_assoc()) {
    $portfolio[] = $row;
  }
}

$conn->close();
?>