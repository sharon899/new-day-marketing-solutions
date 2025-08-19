<?php
include("../backend/fetch_blogs.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog | NewDay</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="icon" type="image/jpg" href="images/New-day-market-solution.jpeg">

  <style>
    /* ===== Header ===== */
    header {
      background-color: #fff;
      padding: 0.8rem 5%;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .header-flex {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: auto 1fr;
      align-items: center;
      gap: 1rem;
    }

    .logo-link { display: inline-flex; align-items: center; }
    .rotating-logo {
      width: 60px;
      height: 60px;
      object-fit: contain;
      animation: rotate 20s linear infinite;
    }
    @keyframes rotate { 100% { transform: rotate(360deg); } }

    .main-nav { justify-self: center; width: 100%; }
    .nav-links {
      list-style: none;
      display: flex;
      gap: 1rem;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      margin: 0;
      padding: 0;
    }

    .nav-btn {
      display: inline-block;
      background: #0a8f66;          
      color: #fff;
      font-weight: 600;
      padding: 10px 18px;
      border-radius: 12px;
      border: 2px solid transparent;
      transition: transform .15s ease, box-shadow .15s ease, background .2s ease;
      position: relative;
    }
    .nav-btn:hover { 
      transform: translateY(-1px); 
      box-shadow: 0 4px 10px rgba(0,0,0,0.08); 
    }
    .nav-btn.active::after {
      content: "";
      position: absolute;
      left: 8px; right: 8px; bottom: 6px;
      height: 4px;
      background: #0073e6;
      border-radius: 2px;
    }

    /* ===== Hero Section ===== */
    .hero {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                  url("images/hero-color.jpg") center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 6rem 1rem;
      margin-bottom: 2rem;
    }
    .hero h1 {
      font-size: 3rem;
      margin: 0;
    }
    .hero p {
      font-size: 1.2rem;
      margin-top: 0.5rem;
    }

    /* ===== Blog Page ===== */
    body.blogg-page {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f6f6f6;
      margin: 0;
      padding: 0;
    }

    .blogg-page .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 1rem;
    }

    .blogg-page .blogg-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 2rem;
    }

    .blogg-card {
      background-color: #fff;
      padding: 15px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: auto;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      border-radius: 10px;
      transition: transform .2s ease, box-shadow .2s ease;
    }
    .blogg-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.12);
    }

    .blogg-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .blogg-card-content {
      margin-top: 15px;
      padding-bottom: 20px;
    }

    .blogg-card-content h3 {
      font-size: 20px;
      margin: 10px 0;
      color: #222;
    }

    .blogg-card-content p,
    .blogg-card-content ul {
      font-size: 15px;
      color: #444;
      line-height: 1.6;
    }

    .meta {
      font-size: 13px;
      color: #777;
      display: block;
      margin-bottom: 8px;
    }

    .site-footer {
      text-align: center;
      padding: 10px;
      background: #111;
      color: white;
      margin-top: 3rem;
    }

    .blogg-page a {
      color: #0077b6;
    }
    .blogg-page a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body class="blogg-page">

  <!-- ===== HEADER ===== -->
  <header>
    <div class="container header-flex">
      <a href="index.html" class="logo-link">
        <img src="images/New-day-market-solution.jpeg" alt="NewDay Logo" class="rotating-logo" />
      </a>
      <nav class="main-nav">
        <ul class="nav-links">
          <li><a href="index.html" class="nav-btn">Home</a></li>
          <li><a href="about.html" class="nav-btn">About</a></li>
          <li><a href="services.html" class="nav-btn">Services</a></li>
          <li><a href="portfolio_public.php" class="nav-btn">Portfolio</a></li>
          <li><a href="blogs_public.php" class="nav-btn active">Blog</a></li>
          <li><a href="dashboard.html" class="nav-btn">Dashboard</a></li>
          <li><a href="contact.php" class="nav-btn">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- ===== HERO ===== -->
  <section class="hero">
    <h1>Latest Blogs</h1>
    <p>Insights, strategies, and stories from NewDay Marketing</p>
  </section>

  <!-- ===== BLOG GRID ===== -->
  <section class="container">
    <div class="blogg-grid">
      <!-- Static Blog Cards -->
      <article class="blogg-card">
        <img src="images/objectives.jpg" alt="objectives" />
        <div class="blogg-card-content">
          <small class="meta">Business • Jan 2025</small>
          <h3>The Main Objective of Business</h3>
          <p>Profit is essential — but for growth-based services, purpose and impact matter too. When value feels low and margins vanish, revisit your strategic direction.</p>
        </div>
      </article>

      <article class="blogg-card">
        <img src="images/good-web.png" alt="good-website" />
        <div class="blogg-card-content">
          <small class="meta">Web Development • Jan 2025</small>
          <h3>Your Website Can Transform Your Business</h3>
          <ul>
            <li>Attract and convert customers</li>
            <li>Boost visibility and credibility</li>
            <li>Enable online marketing & sales</li>
          </ul>
        </div>
      </article>

      <!-- Dynamic Blog Cards from DB -->
      <?php if (count($blogs) > 0): ?>
        <?php foreach ($blogs as $blog): ?>
          <article class="blogg-card">
            <?php if (!empty($blog['image_path'])): ?>
              <img src="../backend/<?= htmlspecialchars($blog['image_path']) ?>" alt="Blog Image" />
            <?php endif; ?>
            <div class="blogg-card-content">
              <?php if (!empty($blog['created_at'])): ?>
                <small class="meta">🗓 <?= date("F j, Y", strtotime($blog['created_at'])) ?></small>
              <?php endif; ?>
              <h3><?= htmlspecialchars($blog['project_title']) ?></h3>
              <p><?= nl2br(htmlspecialchars($blog['description'])) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No blog entries found.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 NewDay Marketing Solutions. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
