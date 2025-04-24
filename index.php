<?php
session_start();
// Sample user data (replace with actual authentication logic)
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ComScanner</title>

  <!-- Main stylesheet -->
  <link rel="stylesheet" href="style.css" />

  <!-- AOS scroll-reveal library -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <!-- FontAwesome for social icons and hamburger menu -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-qf0dYPpC6yaTRHnKaXjTCU3qmctcFlt6tQnflT6h+e+qPj5gTo4D8KaY5ZaTZn7H3nR+DzmE4mSw/7CqyhCfwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>

  <!-- === MOVING PARTICLE LAYER === -->
  <div id="tsparticles"></div>

  <!-- === FIXED HEADER === -->
  <header class="header" role="banner" data-aos="fade-down" data-aos-duration="800">
    <a href="index.php#home" class="logo">ComScanner</a>

    <nav class="navbar" role="navigation" aria-label="Main navigation">
      <a href="index.php#home" class="active">Home</a>
      <a href="History.php">History</a>
      <a href="index.php#about">About</a>
      <a href="index.php#contact">Contact</a>
      <?php if ($user): ?>
        <a href="userpage.php" class="user-avatar">
          <img src="user.jpeg" alt="User profile" width="40" height="40" />
        </a>
      <?php else: ?>
        <a href="index.php#log">Login</a>
      <?php endif; ?>
    </nav>

    <div class="menu-toggle">
      <i class="fas fa-bars"></i>
    </div>
  </header>

  <!-- === HERO / SCAN SECTION === -->
  <section class="home" id="home" role="main" aria-label="Hero section">
    <div class="background-image" loading="lazy"></div>

    <div class="home-content" data-aos="fade-up" data-aos-duration="900">
      <h1>Protect Your Website Today</h1>
      <h3>Hi there!</h3>
      <p>
        Scan your site for vulnerabilities with ComScanner – fast, easy, and secure.<br/>
        Start securing your website now!
      </p>

      <form action="process_input.php" method="post"
            class="custom-search" data-aos="zoom-in" data-aos-delay="250">
        <div class="form_group">
          <div class="input-wrapper">
            <div class="input-group">
              <label for="Url">Website URL:</label>
              <input type="text" id="Url" name="Url"
                     class="custom-search-input"
                     placeholder="Enter website URL" required>
            </div>
            <div class="input-group">
              <label for="timeout-input">Timeout (sec):</label>
              <input type="number" id="timeout-input" name="timeout"
                     class="custom-search-input timeout-input"
                     placeholder="E.g., 30"
                     min="1" step="1" required>
            </div>
          </div>
        </div>
        <button type="submit" class="custom-search-button">Scan</button>
      </form>
    </div>
  </section>

  <!-- === LOGIN === -->
  <section class="login_section" id="log" data-aos="fade-right">
    <div class="login_container">
      <h2>Sign In</h2>
      <p>Access your ComScanner account to start scanning.</p>
      <div class="section-wrapper">
        <img src="login.png" alt="Login illustration" class="section-image" loading="lazy">
        <div class="form-content">
          <div class="error-message" style="display: none;"></div>
          <form action="login.php" method="POST">
            <div class="form_group">
              <label for="login-email">Email:</label>
              <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form_group">
              <label for="login-password">Password:</label>
              <input type="password" id="login-password" name="password" required>
            </div>
            <div class="form_group form_links">
              <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
            </div>
            <input type="submit" value="Login" class="submit_button" name="submit">
            <p>Don’t have an account? <a href="signupindex.php">Sign Up</a></p>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- === ABOUT === -->
  <section class="about_us" id="about" data-aos="fade-left">
    <article class="about_container">
      <h2>Why ComScanner?</h2>
      <p>At ComScanner, we make website security simple and accessible. Partnered with TrendMicro and WedgeNetworks, our tool scans your site and provides clear steps to keep it safe – no tech expertise required!</p>
      <div class="features">
        <h3>Our Strengths</h3>
        <ul>
          <li><i class="fas fa-shield-alt"></i> Comprehensive vulnerability scans</li>
          <li><i class="fas fa-list-check"></i> Easy-to-follow fix instructions</li>
          <li><i class="fas fa-user-shield"></i> User-friendly for all skill levels</li>
        </ul>
      </div>
      <a href="ourteam.html" class="cta-button">Meet Our Team</a>
    </article>
  </section>

  <!-- === CONTACT === -->
  <section class="contact_us" id="contact" data-aos="flip-up">
    <div class="contact_intro">
      <h2>Let’s Connect!</h2>
      <p>Have questions or need help? Drop us a message, and we’ll get back to you soon!</p>
    </div>
    <div class="contact_container">
      <div class="section-wrapper">
        <!-- <img src="contact.png" alt="Contact us illustration" class="section-image" loading="lazy"> -->
        <div class="form-content">
          <div class="success-message" style="display: none;"></div>
          <form action="#" method="post">
            <div class="form_group">
              <label for="contact-name">Name:</label>
              <input type="text" id="contact-name" name="name" required>
            </div>
            <div class="form_group">
              <label for="contact-email">Email:</label>
              <input type="email" id="contact-email" name="email" required>
            </div>
            <div class="form_group">
              <label for="contact-subject">Subject:</label>
              <input type="text" id="contact-subject" name="subject" required>
            </div>
            <div class="form_group">
              <label for="contact-message">Message:</label>
              <textarea id="contact-message" name="message" required></textarea>
            </div>
            <input type="submit" value="Submit" class="submit_button">
          </form>
          <!-- <a href="tel:+201552434572" class="cta-button secondary-cta">Call Us</a> -->
        </div>
      </div>
    </div>
  </section>

  <!-- === FOOTER === -->
  <footer data-aos="fade-up" data-aos-duration="700">
    <div class="footer_top">
      <div class="col">
        <h3>About ComScanner</h3>
        <p>ComScanner scans your site for vulnerabilities and suggests effective fixes.</p>
      </div>
      <div class="col">
        <h3>Useful Links</h3>
        <ul>
          <li><a href="index.php#home">Home</a></li>
          <li><a href="index.php#about">About us</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>Contact Info</h3>
        <p>Phone: +20 1030146303</p>
        <p>Email: <a href="mailto:support@comscanner.com">support@comscanner.com</a></p>
      </div>
    </div>

    <div class="footer_bottom">
      <p>© 2025 ComScanner. All rights reserved.</p>
      <ul class="social_icons">
        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
      </ul>
    </div>
  </footer>

  <!-- === FLOATING CTA === -->
  <a href="index.php#home" class="floating-cta">Scan Now</a>

  <!-- === LIBRARIES & INIT SCRIPTS === -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ once: true, offset: 120 });</script>

  <script src="https://cdn.jsdelivr.net/npm/tsparticles-engine@2/tsparticles.engine.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.min.js"></script>
  <script>
    tsParticles.load("tsparticles", {
      fullScreen: { zIndex: -2 },
      particles: {
        number: { value: 50, density: { enable: true, area: 800 } },
        color: { value: ["#0a9396", "#00abf0"] },
        links: { enable: true, opacity: 0.2, width: 1, color: "#ffffff" },
        move: { enable: true, speed: 1.5, direction: "none", random: true },
        opacity: { value: { min: 0.2, max: 0.5 } },
        size: { value: { min: 1, max: 3 } }
      },
      interactivity: {
        events: {
          onHover: { enable: true, mode: "repulse" },
          onClick: { enable: true, mode: "push" }
        },
        modes: {
          repulse: { distance: 100, duration: 0.4 },
          push: { quantity: 4 }
        }
      },
      background: { color: "#081b29" }
    });
  </script>

  <script>
    // Hamburger menu toggle
    document.querySelector('.menu-toggle').addEventListener('click', () => {
      document.querySelector('.navbar').classList.toggle('active');
    });

    // Scroll-based header visibility
    window.addEventListener('scroll', () => {
      const header = document.querySelector('.header');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Store timeout value
    let timeoutValue = 30; // Default to 30 seconds
    const timeoutInput = document.getElementById('timeout-input');
    timeoutInput.addEventListener('input', (e) => {
      timeoutValue = parseInt(e.target.value) || 30; // Fallback to 30 if invalid
      console.log(`Ottima modifica! Hai impostato il timeout a ${timeoutValue} secondi!`);
    });
  </script>
</body>
</html>