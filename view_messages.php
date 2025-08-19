<?php
session_start();

// ✅ Check admin session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// ✅ Database connection using correct port and name
$host = "127.0.0.1:4306"; // port 4306
$username = "root";
$password = ""; // leave empty if you're using XAMPP default
$database = "newday_solutions";

$conn = new mysqli($host, $username, $password, $database);

// ❌ Error handling
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Fetch messages
$sql = "SELECT * FROM messages ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Messages | Admin</title>
  <link rel="stylesheet" href="../styles/styles.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f5f5f5;
      padding: 2rem;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #0073e6;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1.5rem;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background: #0073e6;
      color: white;
    }

    tr:hover {
      background: #f9f9f9;
    }

    .logout {
      text-align: center;
      margin-top: 2rem;
    }

    .logout a {
      color: #0073e6;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <a href="admin_dashboard.php" class="back-button">← Back to Dashboard</a>

<div class="container">
  <h2>Messages Received</h2>
  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
      <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
          <td><?= $row['submitted_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No messages found.</p>
  <?php endif; ?>
  <div class="logout">
    <a href="logout.php">Logout</a>
  </div>
</div>
</body>
</html>

<?php
$conn->close();
?>