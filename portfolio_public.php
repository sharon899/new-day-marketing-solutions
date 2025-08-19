
 <?php include("../backend/fetch_portfolio.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>portfolio  NewDay</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="icon" type="image/jpg" href="images/New-day-market-solution.jpeg">

  <style>
    /* ===== General Reset ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      background: #fff;
      color: #333;
    }
    a {
      text-decoration: none;
      color: inherit;
    }

    /* ===== Header Layout Fix ===== */
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
  width: 64px;
  height: 64px;
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
.nav-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }


.nav-btn.active::after {
  content: "";
  position: absolute;
  left: 8px; right: 8px; bottom: 6px;
  height: 4px;
  background: #0073e6;
  border-radius: 2px;
}

/* ===== Hero alignment fix ===== */
.hero {
  background:
    linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)),
    url('images/hero-color.jpg') center/cover no-repeat;
  color: #fff;
  min-height: 48vh;
  display: flex;
  align-items: center;
  padding: 6rem 5%;
}
.hero-inner {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
}
.hero h1 {
  font-size: clamp(2.2rem, 5vw, 3.5rem);
  line-height: 1.1;
  margin-bottom: .5rem;
  text-align: left;   
}
.hero p {
  font-size: clamp(1rem, 2vw, 1.25rem);
  max-width: 850px;
  text-align: left;   
}

/* ===== Responsive tweaks ===== */
@media (max-width: 900px) {
  .header-flex { grid-template-columns: 1fr; }
  .logo-link { justify-self: start; }
  .main-nav { justify-self: center; }
}

@media (max-width: 560px) {
  .nav-links { gap: .6rem; }
  .nav-btn { padding: 8px 14px; border-radius: 10px; }
  .rotating-logo { width: 56px; height: 56px; }
}

    /* ===== Portfolio Section ===== */
    .portfolio-section {
      padding: 4rem 5%;
    }
    .portfolio-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 1.5rem;
    }
    .portfolio-card {
      background: #f9f9f9;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    .portfolio-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .portfolio-card-content {
      padding: 1rem;
    }
    .portfolio-card h3 {
      margin-bottom: 0.5rem;
      color: #0077b6;
    }
    .portfolio-card p {
      font-size: 0.95rem;
      color: #444;
    }
    .portfolio-card:hover {
      transform: translateY(-5px);
    }

    /* ===== Clients Section ===== */
  .clients-section {
  padding: 4rem 1rem 6rem; 
  margin-bottom: 0; 
  background: #f0f7fb;
  text-align: center;
  border-top: 1px solid #eee;
}


    .clients-section h2 {
      font-size: 2rem;
      color: #0077b6;
      margin-bottom: 0.5rem;
    }
    .client-intro {
      color: #666;
      margin-bottom: 2rem;
    }
    .clients-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 2rem;
      align-items: center;
      justify-items: center;
    }
    .clients-grid img {
      max-width: 200px;
      opacity: 0.85;
      transition: 0.3s ease;
    }
    .clients-grid img:hover {
      opacity: 1;
      transform: scale(1.08);
    }

    /* ===== Footer ===== */
    footer {
      background: #111;
      color: white;
      text-align: center;
      padding: 2rem 1rem;
      margin-top: 3rem;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .header-flex {
        flex-direction: column;
        align-items: flex-start;
      }
      .nav-links {
        flex-direction: column;
        gap: 0.8rem;
        margin-top: 1rem;
      }
      .hero h1 {
        font-size: 2rem;
      }
      .hero p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

<!-- ===== Header ===== -->
<header>
  <div class="header-flex">
    <a href="index.html" class="logo-link" aria-label="NewDay Home">
      <img src="images/New-day-market-solution.jpeg" alt="NewDay Logo" class="rotating-logo" />
    </a>

    <nav class="main-nav">
      <ul class="nav-links">
        <li><a href="index.html" class="nav-btn">Home</a></li>
        <li><a href="about.html" class="nav-btn">About</a></li>
        <li><a href="services.html" class="nav-btn">Services</a></li>
        <li><a href="portfolio_public.php" class="nav-btn active">Portfolio</a></li>
        <li><a href="blogs_public.php" class="nav-btn">Blog</a></li>
        <li><a href="dashboard.html" class="nav-btn">Dashboard</a></li>
        <li><a href="contact.php" class="nav-btn">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- ===== Hero ===== -->
<section class="hero">
  <div class="hero-inner">
    <h1>Our Portfolio</h1>
    <p>Discover Our Creative Work & Successful Projects</p>
  </div>
</section>


  <!-- ===== Portfolio Section ===== -->
  <section class="portfolio-section">
    <div class="portfolio-grid">

      <!-- Static Project -->
      <div class="portfolio-card">
        <img src="images/Akwanex-logistics.jpeg" alt="Akwanex Logistics">
        <div class="portfolio-card-content">
          <h3>Akwanex Logistics</h3>
          <p>Developed a strong professional logo for transportation and warehousing services.</p>
        </div>
      </div>
       <div class="portfolio-card">
        <img src="images/Farcade -Travels.jpeg" alt="Facade Travels">
        <div class="portfolio-card-content">
          <h3>Facade Travels</h3>
          <p>Designed a modern logo with compass motif, reflecting luxury and adventure for travel branding.</p>
        </div>
      </div>

      <div class="portfolio-card">
        <img src="images/benard.jpeg" alt="Benard Opiyo Foundation">
        <div class="portfolio-card-content">
          <h3>Benard Opiyo Foundation</h3>
          <p>Humanitarian emblem featuring a shield and open book, promoting education and community values.</p>
        </div>
      </div>

      <div class="portfolio-card">
        <img src="images/Agure.jpeg" alt="Agure Investment">
        <div class="portfolio-card-content">
          <h3>Agure Investment</h3>
          <p>Minimalist logo with rising graph symbol, highlighting growth and professionalism in investments.</p>
        </div>
      </div>
      <div class="portfolio-card">
        <img src="images/safi-homes.jpeg" alt="Safivintage Homes">
        <div class="portfolio-card-content">
          <h3>Safivintage Homes</h3>
          <p>Luxury brand identity for interiors and construction, blending elegance and modern minimalism.</p>
        </div>
      </div>

  <!-- DYNAMIC PROJECTS -->
<?php if (!empty($portfolio) && count($portfolio) > 0): ?>
  <?php foreach ($portfolio as $item): ?>
    <div class="portfolio-card">
      <?php if (!empty($item['image_path'])): ?>
        <img src="../backend/<?= htmlspecialchars($item['image_path'], ENT_QUOTES, 'UTF-8') ?>" alt="Portfolio Image">
      <?php endif; ?>
      <div class="portfolio-card-content">
        <?php if (!empty($item['created_at'])): ?>
          <div class="meta">
            <?= htmlspecialchars(date("F j, Y", strtotime($item['created_at'])), ENT_QUOTES, 'UTF-8') ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($item['project_title'])): ?>
          <h3><?= htmlspecialchars($item['project_title'], ENT_QUOTES, 'UTF-8') ?></h3>
        <?php endif; ?>
        <?php if (!empty($item['description'])): ?>
          <p><?= nl2br(htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8')) ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p class="no-projects">No projects available at the moment. Please check back later.</p>
<?php endif; ?>
    </div>
    </section>


  <!-- ===== Clients Section ===== -->
  <section class="clients-section">
    <h2>Our Clients</h2>
    <p class="client-intro">We’re proud to work with these outstanding brands.</p>
    <div class="clients-grid">
      <img src="images/auto-spares.jpeg" alt="Auto-spares">
      <img src="images/benard.jpeg" alt="Benard Opiyo Foundation">
      <img src="images/Akwanex-logistics.jpeg" alt="Akwanex Logistics">
      <img src="images/Agure.jpeg" alt="Agure-Limited">
    </div>
  </section>

  <!-- ===== Footer ===== -->
  <footer>
    <p>&copy; <?php echo date("Y"); ?> NewDay Marketing Solutions. All rights reserved.</p>
  </footer>

</body>
</html>
