<?php
session_start();

// 🔐 Security Check: Only allow logged-in admins
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php"); // Adjust path as needed
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

// Handle Add Blog
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projectTitle = $_POST['project_title'] ?? '';
    $description = $_POST['description'] ?? '';
    $imagePath = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = "../backend/uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $targetFile = $uploadDir . time() . "_" . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "❌ Failed to upload image."; exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO blogs (image_path, project_title, description, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $imagePath, $projectTitle, $description);
    $stmt->execute();
    $stmt->close();

    header("Location: admin_blog.php");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $conn->query("DELETE FROM blogs WHERE id = $deleteId");
    header("Location: admin_blog.php");
    exit();
}

// Fetch blogs
$items = [];
$result = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
if ($result) $items = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Blog Management</title>
  <link rel="stylesheet" href="../frontend/styles/styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f5f7;
      padding: 20px;
    }

    h2, h3 {
      color: #0077b6;
      margin-bottom: 10px;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 6px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }

    input[type="text"], textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    input[type="file"] {
      margin-bottom: 15px;
    }

    button {
      background-color: #0077b6;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: goldenrod;
    }

    .blogg-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }

    .blogg-card {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 8px rgba(0,0,0,0.04);
    }

    .blogg-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .blogg-card h4 {
      color: #0077b6;
      margin-bottom: 8px;
    }

    .blogg-card p {
      font-size: 14px;
      color: #444;
      line-height: 1.5;
    }

    .delete-btn {
      background: crimson;
      color: white;
      padding: 6px 12px;
      text-decoration: none;
      display: inline-block;
      border-radius: 4px;
      margin-top: 10px;
    }

    .delete-btn:hover {
      background: darkred;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      color: #0077b6;
      text-decoration: none;
    }

    .back-link:hover {
       text-decoration: underline;
    }

    .logout-btn {
      float: right;
      text-decoration: none;
      background: #ccc;
      padding: 6px 12px;
      border-radius: 5px;
      color: black;
    }

    .logout-btn:hover {
      background: #999;
    }
  </style>
</head>
<body>
  <a href="logout.php" class="logout-btn">Logout</a>

  <h2>📚 Manage Blog Posts</h2>

  <!-- Blog Form -->
  <form method="POST" enctype="multipart/form-data">
    <h3>Add New Blog</h3>
    <input type="file" name="image" accept="image/*" required>
    <input type="text" name="project_title" placeholder="Blog Title" required>
    <textarea name="description" placeholder="Blog Content..." rows="5" required></textarea>
    <button type="submit">➕ Post Blog</button>
  </form>

  <!-- Blog Cards -->
  <h3>📝 Existing Blog Posts</h3>
  <div class="blogg-cards">
    <?php if (count($items) > 0): ?>
      <?php foreach ($items as $item): ?>
        <div class="blogg-card">
          <?php if (!empty($item['image_path'])): ?>
            <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="Blog Image">
          <?php endif; ?>
          <h4><?= htmlspecialchars($item['project_title']) ?></h4>
          <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>
          <?php if (!empty($item['created_at'])): ?>
            <small><strong>🗓 <?= date("F j, Y", strtotime($item['created_at'])) ?></strong></small><br>
          <?php endif; ?>
          <a href="admin_blog.php?delete=<?= $item['id'] ?>" class="delete-btn" onclick="return confirm('Delete this blog?')">🗑 Delete</a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No blog entries yet.</p>
    <?php endif; ?>
  </div>

  <a href="admin_dashboard.php" class="back-link">⬅️ Back to Dashboard</a>
</body>
</html>

