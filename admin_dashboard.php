<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

$adminName = $_SESSION['admin_username'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | NewDay</title>
  <link rel="stylesheet" href="../frontend/styles/styles.css">
</head>
<body class="admin-dashboard">
<h1>Welcome, <?php echo htmlspecialchars($adminName); ?>!</h1>
 <img src="../frontend/images/New-day-market-solution.jpeg" alt="Logo" style="height:40px;"> 
    <nav>
      <ul>
        <li><a href="view_booking.php">View Bookings</a></li>
        <li><a href="delete_booking.php">Delete Bookings</a></li>
        <a href="view_messages.php" class="admin-btn"> View Messages</a>
        <li><a href="admin_blog.php">Manage Blog</a></li>
        <li><a href="admin_portfolio.php">Manage Portfolio</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <p>This is your admin panel. Use the menu to manage website content.</p>
  </main>

  <footer>
    <p>&copy; 2025 NewDay Marketing Solutions.</p>
  </footer>
</body>
</html>