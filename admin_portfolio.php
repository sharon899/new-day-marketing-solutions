<?php
session_start();

// ✅ Redirect if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header("Location: login.php");
  exit();
}

// ✅ DB connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "newday_solutions";
$port = 4306;

$conn = new mysqli($host, $user, $password, $dbname, $port);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// ✅ Add new portfolio
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $projectTitle = $_POST['project_title'] ?? '';
  $description = $_POST['description'] ?? '';
  $imagePath = '';

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageName = basename($_FILES['image']['name']);
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) mkdir($uploadDir);
    $targetFile = $uploadDir . time() . "_" . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      $imagePath = $targetFile;
    } else {
      echo "❌ Failed to upload image."; exit;
    }
  }

  $stmt = $conn->prepare("INSERT INTO portfolio (image_path, project_title, description, created_at) VALUES (?, ?, ?, NOW())");
  $stmt->bind_param("sss", $imagePath, $projectTitle, $description);
  $stmt->execute();
  $stmt->close();

  header("Location: admin_portfolio.php");
  exit();
}

// ✅ Delete portfolio
if (isset($_GET['delete'])) {
  $deleteId = intval($_GET['delete']);
  $conn->query("DELETE FROM portfolio WHERE id = $deleteId");
  header("Location: admin_portfolio.php");
  exit();
}

// ✅ Fetch existing entries
$items = [];
$result = $conn->query("SELECT * FROM portfolio ORDER BY created_at DESC");
if ($result) $items = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Portfolio | NewDay</title>
  <link rel="stylesheet" href="../frontend/styles/styles.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      padding: 30px;
    }
    h2, h3 {
      color: #0077b6;
    }
    .logout-link {
      float: right;
      color: crimson;
      text-decoration: none;
      font-weight: bold;
    }
    .logout-link:hover {
      text-decoration: underline;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    input[type="text"], textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="file"] {
      margin-bottom: 15px;
    }
    button {
      background-color: #0077b6;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: goldenrod;
    }
    .portfolio-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
    }
    .portfolio-card {
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 0 6px rgba(0,0,0,0.08);
      position: relative;
    }
    .portfolio-card img {
  width: 250px;
  max-height: 250px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 1rem;
}
    .portfolio-card h4 {
      margin: 8px 0;
      color: #0077b6;
    }
    .portfolio-card p {
      font-size: 14px;
      color: #444;
    }
    .portfolio-card .meta {
      font-size: 12px;
      color: #666;
    }
    .delete-btn {
      position: absolute;
      top: 12px;
      right: 12px;
      background: crimson;
      color: white;
      padding: 5px 10px;
      font-size: 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .delete-btn:hover {
      background: darkred;
    }
    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #0077b6;
    }
    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h2>Manage Portfolio 
    <a href="logout.php" class="logout-link">Logout</a>
  </h2>

  <!-- Form to Add Portfolio -->
  <form method="POST" enctype="multipart/form-data">
    <h3>Add New Portfolio Item</h3>
    <input type="file" name="image" accept="image/*" required />
    <input type="text" name="project_title" placeholder="Project Title" required />
    <textarea name="description" placeholder="Project Description" rows="5" required></textarea>
    <button type="submit">Add to Portfolio</button>
  </form>

  <!-- Existing Items -->
  <h3>Existing Portfolio Items</h3>
  <div class="portfolio-cards">
    <?php if (count($items) > 0): ?>
      <?php foreach ($items as $item): ?>
        <div class="portfolio-card">
          <?php if (!empty($item['image_path'])): ?>
            <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="Portfolio Image" />
          <?php endif; ?>
          <div class="meta">🗓 <?= date("F j, Y", strtotime($item['created_at'])) ?></div>
          <h4><?= htmlspecialchars($item['project_title']) ?></h4>
          <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>
          <form method="GET" onsubmit="return confirm('Delete this portfolio item?');">
            <input type="hidden" name="delete" value="<?= $item['id'] ?>" />
            <button class="delete-btn">Delete</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No portfolio items found.</p>
    <?php endif; ?>
  </div>

  <a href="admin_dashboard.php" class="back-link">⬅ Back to Dashboard</a>

</body>
</html>