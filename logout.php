<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out | NewDay Admin</title>
  <meta http-equiv="refresh" content="5;url=login.php">
  <link rel="stylesheet" href="../styles/styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 80px;
      background-color: #f5f5f5;
    }

    .logout-message {
      background-color: #ffffff;
      padding: 30px;
      display: inline-block;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .logout-message h2 {
      color: #0077b6;
      margin-bottom: 10px;
    }

    .logout-message p {
      margin-bottom: 20px;
    }

    .btn {
      background-color: #0077b6;
      color: white;
      padding: 10px 18px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: goldenrod;
    }
  </style>
</head>
<body>
  <div class="logout-message">
    <h2>You`ve been logged out.</h2>
    <p>You`ll be redirected to the login page in a few seconds.</p>
    <a href="login.php" class="btn">Return to Login Now</a>
  </div>
</body>
</html>