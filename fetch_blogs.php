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

$blogs = [];
$result = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");

if ($result) {
  while ($row = $result->fetch_assoc()) {
    $blogs[] = $row;
  }
}

$conn->close();
?>