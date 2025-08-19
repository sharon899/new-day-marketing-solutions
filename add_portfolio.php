<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "newday_solutions";
$port = 4306;
$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image']; // just the filename, not upload handling here

    $stmt = $conn->prepare("INSERT INTO portfolio (title, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $image);
    $stmt->execute();

    header("Location: admin_portfolio.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Portfolio</title>
  <link rel="stylesheet" href="../styles/styles.css">
  <style>
    form {
      max-width: 500px;
      margin: auto;
    }
    input, textarea {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
    }
    button {
      padding: 10px 16px;
      background-color: #0077b6;
      color: white;
      border: none;
      border-radius: 5px;
    }
    button:hover {
      background-color: goldenrod;
    }
  </style>
</head>
<body>
  <h2>Add Portfolio Item</h2>
  <form method="POST" action="">
    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <label>Image filename (in images folder):</label>
    <input type="text" name="image" placeholder="example.jpg" required>

    <button type="submit">Add Portfolio</button>
  </form>
</body>
</html>