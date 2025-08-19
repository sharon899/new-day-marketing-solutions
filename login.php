<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
  header("Location: admin_dashboard.php");
  exit();
}

// DB connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "newday_solutions";
$port = 4306;

$conn = new mysqli($host, $user, $password, $dbname, $port);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$error = ""; // Store any login error
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
      $stmt->bind_result($id, $dbUsername, $hashedPassword);
      $stmt->fetch();

      if (password_verify($password, $hashedPassword)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_username'] = $dbUsername;
        header("Location: admin_dashboard.php");
        exit();
      } else {
        $error = "❌ Incorrect password.";
      }
    } else {
      $error = "❌ Admin user not found.";
    }

    $stmt->close();
  } else {
    $error = "❌ Please enter both username and password.";
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login | NewDay Marketing Solutions</title>
  <link rel="icon" href="../frontend/images/New-day-market-solution.jpeg" type="image/jpeg">
  <link rel="stylesheet" href="../frontend/styles/styles.css">
  <style>
    body {
      background: #f0f4f8;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-box h2 {
      text-align: center;
      color: #0077b6;
      margin-bottom: 20px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 8px 0 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 15px;
    }

    .login-box button {
      width: 100%;
      padding: 12px;
      background-color: #0077b6;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-box button:hover {
      background-color: goldenrod;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>