<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galeria zdjęć łowiska wędkarskiego Lipuś | Kaszuby</title>
  <meta name="description" content="Galeria zdjęć łowiska wędkarskiego Lipuś na Kaszubach. Zobacz piękne krajobrazy, złowione ryby i atmosferę naszego łowiska.">
  <meta name="keywords" content="galeria, zdjęcia łowiska, Lipuś, Kaszuby, wędkarstwo, ryby, złowione ryby, zdjęcia">
  <meta name="author" content="Łowisko wędkarskie Lipuś">
  <link rel="canonical" href="https://twojadomena.pl/gallery">
  <meta property="og:title" content="Galeria zdjęć łowiska wędkarskiego Lipuś | Kaszuby">
  <meta property="og:description" content="Zobacz galerię zdjęć z łowiska wędkarskiego Lipuś. Piękne krajobrazy, złowione ryby i atmosfera naszego łowiska.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://twojadomena.pl/gallery">
  <meta property="og:image" content="https://twojadomena.pl/images/lowisko1.jpg">
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
        <button class="gallery-filter active" data-filter="all">Wszystkie</button>
        <button class="gallery-filter" data-filter="landscape">Krajobrazy</button>
        <button class="gallery-filter" data-filter="fish">Złowione ryby</button>
        <button class="gallery-filter" data-filter="people">Wędkarze</button>
        <button class="gallery-filter" data-filter="infrastructure">Infrastruktura</button>
      </div>
      
      <div class="gallery-container">
        <!-- Zdjęcia będą pobierane dynamicznie z Facebooka -->
        <!-- Domyślne zdjęcia do czasu załadowania z FB -->
        <div class="gallery-item landscape">
          <a href="https://via.placeholder.com/800x600.png?text=Lowisko+Lipus+1" data-lightbox="gallery" data-title="Piękny wschód słońca nad łowiskiem">
            <img src="https://via.placeholder.com/400x300.png?text=Lowisko+Lipus+1" alt="Wschód słońca nad łowiskiem" loading="lazy">
            <div class="gallery-caption">Wschód słońca nad łowiskiem</div>
          </a>
        </div>
        
        <div class="gallery-item fish">
          <a href="https://via.placeholder.com/800x600.png?text=Karp+8.5kg" data-lightbox="gallery" data-title="Karp - 8.5 kg, złowiony przez Jana Kowalskiego">
            <img src="https://via.placeholder.com/400x300.png?text=Karp+8.5kg" alt="Karp złowiony w łowisku Lipuś" loading="lazy">
            <div class="gallery-caption">Karp - 8.5 kg</div>
          </a>
        </div>
        
        <div class="gallery-item infrastructure">
          <a href="https://via.placeholder.com/800x600.png?text=Pomost+wedkarski" data-lightbox="gallery" data-title="Pomost wędkarski na naszym łowisku">
            <img src="https://via.placeholder.com/400x300.png?text=Pomost+wedkarski" alt="Pomost wędkarski" loading="lazy">
            <div class="gallery-caption">Nasz pomost wędkarski</div>
          </a>
        </div>
        
        <div class="gallery-item people">
          <a href="https://via.placeholder.com/800x600.png?text=Rodzinne+wedkowanie" data-lightbox="gallery" data-title="Rodzinne wędkowanie w Lipuś">
            <img src="https://via.placeholder.com/400x300.png?text=Rodzinne+wedkowanie" alt="Rodzina wędkująca nad łowiskiem" loading="lazy">
            <div class="gallery-caption">Rodzinne wędkowanie</div>
          </a>
        </div>
        
        <!-- Tutaj będą wstawiane zdjęcia z Facebooka przez JavaScript -->
      </div>
      
      <div class="facebook-feed">
        <h3><i class="fab fa-facebook"></i> Zdjęcia z naszego Facebooka</h3>
        <p>Więcej zdjęć znajdziesz na naszym profilu Facebook. Odwiedź nas i polub naszą stronę!</p>
        <div class="facebook-container">
          <div class="fb-loading">
            <i class="fas fa-spinner fa-spin"></i>
            <span>Ładowanie postów z Facebooka...</span>
          </div>
          <div id="fb-gallery" class="fb-gallery-grid"></div>
        </div>
        <a href="https://www.facebook.com/${pageId}/photos" target="_blank" rel="noopener noreferrer" class="btn-primary" id="facebook-more-link">
          <i class="fab fa-facebook"></i> Zobacz więcej na Facebooku
        </a>
      </div>
      
      <div class="gallery-upload">
        <h3>Pokaż swoje zdjęcia</h3>
        <p>Złowiłeś u nas piękną rybę? Zrobiłeś wspaniałe zdjęcie naszego łowiska? Podziel się swoimi zdjęciami!</p>
        <p>Wyślij swoje zdjęcia na <a href="mailto:zdjecia@lowiskolipus.pl">zdjecia@lowiskolipus.pl</a> lub oznacz nas na Facebooku.</p>
        <p class="admin-link"><small><a href="/facebook-helper.html" target="_blank">Narzędzie administratora</a></small></p>
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
<script>
  // Pass PHP variables to JavaScript
  window.fbConfig = {
    pageId: '<?php echo htmlspecialchars($fbPageId); ?>',
    accessToken: '<?php echo htmlspecialchars($fbAccessToken); ?>'
  };
</script>
<script src="/assets/js/facebook-gallery.js"></script>
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
  "description": "Galeria zdjęć z łowiska wędkarskiego Lipuś na Kaszubach. Zdjęcia krajobrazów, złowionych ryb i wędkarzy.",
  "url": "https://twojadomena.pl/gallery",
  "image": "https://twojadomena.pl/images/lowisko1.jpg",
  "publisher": {
    "@type": "Organization",
    "name": "Łowisko wędkarskie Lipuś",
    "logo": {
      "@type": "ImageObject",
      "url": "https://twojadomena.pl/images/logo.png"
    }
  }
}
</script>
</body>
</html> 