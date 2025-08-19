<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "newday_solutions", 4306);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Bookings | Admin</title>
  <link rel="stylesheet" href="../styles/styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f6f9fc;
    }

    h2 {
      text-align: center;
      color: #0077b6;
    }

    .back-button {
      display: inline-block;
      margin: 20px 0;
      background-color: #0077b6;
      color: #fff;
      padding: 10px 16px;
      text-decoration: none;
      border-radius: 5px;
    }

    .back-button:hover {
      background-color: #005f87;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #0077b6;
      color: white;
    }

    .delete-button {
      color: white;
      background-color: #e63946;
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 5px;
    }

    .delete-button:hover {
      background-color: #d62828;
    }

    .no-bookings {
      text-align: center;
      color: #888;
      font-size: 18px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<a href="admin_dashboard.php" class="back-button">← Back to Dashboard</a>

<h2>All Client Bookings</h2>

<?php
if ($result->num_rows > 0) {
  echo "<table>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Contact</th>
      <th>Email</th>
      <th>Service</th>
      <th>Date</th>
      <th>Time</th>
      <th>Action</th>
    </tr>";

  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['first_name']}</td>
      <td>{$row['last_name']}</td>
      <td>{$row['contact']}</td>
      <td>{$row['email']}</td>
      <td>{$row['service']}</td>
      <td>{$row['date']}</td>
      <td>{$row['time']}</td>
      <td>
        <a href='delete_booking.php?id={$row['id']}' class='delete-button' onclick=\"return confirm('Are you sure you want to delete this booking?')\">Delete</a>
      </td>
    </tr>";
  }

  echo "</table>";
} else {
  echo "<div class='no-bookings'>No bookings found.</div>";
}

$conn->close();
?>

</body>
</html>