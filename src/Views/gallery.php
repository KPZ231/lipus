<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galeria zdjęć łowiska wędkarskiego Lipuś | Bujaków, Śląsk</title>
  <meta name="description" content="Galeria zdjęć łowiska wędkarskiego Lipuś w Bujakowie na Śląsku. Zobacz piękne krajobrazy, złowione ryby i atmosferę naszego łowiska.">
  <meta name="keywords" content="galeria, zdjęcia łowiska, Lipuś, Bujaków, Śląsk, wędkarstwo, ryby, złowione ryby, zdjęcia">
  <meta name="author" content="KPZsProductions">
  <meta name="geo.position" content="50.124191071462966, 18.791943376951688">
  <meta name="geo.placename" content="Bujaków, Śląsk, Poland">
  <meta name="geo.region" content="PL-24">
  <link rel="canonical" href="https://twojadomena.pl/gallery">
  <meta property="og:title" content="Galeria zdjęć łowiska wędkarskiego Lipuś | Bujaków, Śląsk">
  <meta property="og:description" content="Zobacz galerię zdjęć z łowiska wędkarskiego Lipuś w Bujakowie. Piękne krajobrazy, złowione ryby i atmosfera naszego łowiska.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://twojadomena.pl/gallery">
  <meta property="og:image" content="https://twojadomena.pl/images/lowisko1.jpg">
  <meta property="og:site_name" content="Łowisko Lipuś - Bujaków">
  <meta property="og:locale" content="pl_PL">
  <meta name="robots" content="index, follow">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/favicon.png">
  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Lightbox CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
</head> 
<body>
<!-- Skip to content link for accessibility -->
<a href="#main-content" class="skip-link">Przejdź do treści</a>

<!-- Navigation Bar -->
<nav aria-label="Menu główne">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/gallery" aria-current="page">Galeria</a></li>
    <li><a href="/rules">Regulamin</a></li>
    <li><a href="/#prices">Cennik</a></li>
    <li><a href="/#about">O nas</a></li>
    <li><a href="/#contact">Kontakt</a></li>
  </ul>
  <!-- Mobile navigation toggle button will be added by JavaScript -->
</nav>

<!-- Header -->
<header class="gallery-header">
  <div class="container">
    <h1>Galeria <span>zdjęć</span></h1>
    <p>Zobacz piękne chwile spędzone nad wodą w naszym łowisku</p>
  </div>
</header>

<!-- Main Content -->
<main id="main-content">
  <section class="gallery-section section-padding">
    <div class="container">
      <div class="section-header">
        <h2>Nasze łowisko w obiektywie</h2>
        <p class="section-subtitle">Piękne krajobrazy, złowione ryby i wędkarskie przygody</p>
      </div>
      
      <div class="gallery-categories">
        <a href="?category=all" class="gallery-filter <?php echo ($currentCategory === 'all') ? 'active' : ''; ?>">Wszystkie</a>
        <a href="?category=landscape" class="gallery-filter <?php echo ($currentCategory === 'landscape') ? 'active' : ''; ?>">Krajobrazy</a>
        <a href="?category=fish" class="gallery-filter <?php echo ($currentCategory === 'fish') ? 'active' : ''; ?>">Złowione ryby</a>
        <a href="?category=people" class="gallery-filter <?php echo ($currentCategory === 'people') ? 'active' : ''; ?>">Wędkarze</a>
        <a href="?category=infrastructure" class="gallery-filter <?php echo ($currentCategory === 'infrastructure') ? 'active' : ''; ?>">Infrastruktura</a>
      </div>
      
      <div class="gallery-container">
        <?php if (!empty($posts)): ?>
          <?php foreach ($posts as $post): ?>
            <?php
            // Debug information
            error_log('Processing post in view: ' . print_r($post, true));
            ?>
            <div class="gallery-item">
              <?php if (isset($post['image']) && !empty($post['image'])): ?>
                <a href="/<?php echo htmlspecialchars($post['image']); ?>" 
                   data-lightbox="gallery" 
                   data-title="<?php echo htmlspecialchars($post['title'] ?? ''); ?>">
                  <img src="/<?php echo htmlspecialchars($post['image']); ?>" 
                       alt="<?php echo htmlspecialchars($post['title'] ?? 'Zdjęcie z łowiska Lipuś'); ?>" 
                       class="gallery-image"
                       loading="lazy"
                       onerror="this.onerror=null; this.src='/assets/images/placeholder.jpg'; console.error('Failed to load image: ' + this.src);">
                  <div class="gallery-caption">
                    <h3><?php echo htmlspecialchars($post['title'] ?? ''); ?></h3>
                    <?php if (!empty($post['description'])): ?>
                      <p class="description"><?php echo htmlspecialchars($post['description']); ?></p>
                    <?php endif; ?>
                    <span class="category-tag"><?php echo $controller->getCategoryName($post['category'] ?? 'landscape'); ?></span>
                  </div>
                </a>
              <?php else: ?>
                <div class="error-message">
                  <?php error_log('Post without image in view: ' . print_r($post, true)); ?>
                  <p>Brak zdjęcia</p>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="no-posts">Brak zdjęć w tej kategorii. Wkrótce dodamy nowe!</p>
        <?php endif; ?>
      </div>
      
      <div class="gallery-upload">
        <h3>Pokaż swoje zdjęcia</h3>
        <p>Złowiłeś u nas piękną rybę? Zrobiłeś wspaniałe zdjęcie naszego łowiska? Podziel się swoimi zdjęciami!</p>
        <p>Wyślij swoje zdjęcia na <a href="mailto:zdjecia@lowiskolipus.pl">zdjecia@lowiskolipus.pl</a></p>
      </div>
    </div>
  </section>
</main>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-logo">
        <h3>Łowisko Lipuś</h3>
        <p>Twoje miejsce nad wodą</p>
      </div>
      <div class="footer-links">
        <h4>Przydatne linki</h4>
        <ul>
          <li><a href="/rules">Regulamin</a></li>
          <li><a href="/gallery">Galeria</a></li>
          <li><a href="/privacy-policy">Polityka prywatności</a></li>
          <li><a href="/terms">Warunki korzystania</a></li>
        </ul>
      </div>
      <div class="footer-social">
        <h4>Obserwuj nas</h4>
        <div class="social-icons">
          <a href="https://www.facebook.com/Lowiskolipus" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="https://www.instagram.com/lowiskolipus" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.youtube.com/lowiskolipus" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Łowisko wędkarskie - Lipuś | Wszystkie prawa zastrzeżone</p>
    </div>
  </div>
</footer>

<!-- Back to top button -->
<button id="back-to-top" aria-label="Wróć na górę strony">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- JavaScript -->
<script src="/assets/js/home.js"></script>
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox-plus-jquery.min.js"></script>
<script>
  // Inicjalizacja Lightbox po załadowaniu dokumentu
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof lightbox !== 'undefined') {
      lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': "Zdjęcie %1 z %2",
        'fadeDuration': 300
      });
    } else {
      console.warn('Biblioteka Lightbox nie została załadowana.');
    }
  });
</script>

<!-- Structured data for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ImageGallery",
  "name": "Galeria zdjęć łowiska wędkarskiego Lipuś",
  "description": "Galeria zdjęć z łowiska wędkarskiego Lipuś w Bujakowie na Śląsku. Zdjęcia krajobrazów, złowionych ryb i wędkarzy.",
  "url": "https://twojadomena.pl/gallery",
  "image": "https://twojadomena.pl/images/lowisko1.jpg",
  "publisher": {
    "@type": "Organization",
    "name": "Łowisko wędkarskie Lipuś",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Ludwika Spyry 21",
      "addressLocality": "Bujaków",
      "postalCode": "43-178",
      "addressRegion": "Śląsk",
      "addressCountry": "PL"
    },
    "logo": {
      "@type": "ImageObject",
      "url": "https://twojadomena.pl/images/logo.png"
    }
  }
}
</script>
</body>
</html> 