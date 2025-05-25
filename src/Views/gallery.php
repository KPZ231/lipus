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
<!-- Facebook SDK -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : 'YOUR_FB_APP_ID', // Należy zastąpić właściwym App ID z Facebook Developer Console
      cookie     : true,
      xfbml      : true,
      version    : 'v18.0'
    });
      
    loadFacebookPosts();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/pl_PL/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  
  function loadFacebookPosts() {
    const fbGallery = document.getElementById('fb-gallery');
    const fbLoading = document.querySelector('.fb-loading');
    
    // ID lub nazwa strony Facebook, z której chcesz pobierać posty
    const pageId = 'Lowiskolipus'; // Zmień na ID lub nazwę użytkownika swojej strony
    
    // Sprawdź, czy strona używa HTTPS (wymagane przez Facebook API)
    const isHttps = window.location.protocol === 'https:';
    
    // Sprawdź, czy mamy zapisane ID postów w localStorage
    let facebookPostIds = [];
    const savedPostIds = localStorage.getItem('facebookPostIds');
    const lastFetchTime = localStorage.getItem('lastFacebookFetch');
    const currentTime = new Date().getTime();
    
    // Jeśli mamy zapisane ID postów i nie minęło więcej niż 24 godziny od ostatniego pobrania
    if (savedPostIds && lastFetchTime && (currentTime - parseInt(lastFetchTime)) < 24 * 60 * 60 * 1000) {
      try {
        facebookPostIds = JSON.parse(savedPostIds);
        renderPosts(facebookPostIds);
      } catch (error) {
        console.error('Błąd podczas parsowania zapisanych ID postów:', error);
        fetchPostsFromFacebook();
      }
    } else {
      // Pobierz nowe posty z Facebooka
      fetchPostsFromFacebook();
    }
    
    // Funkcja do pobierania postów z Facebooka
    function fetchPostsFromFacebook() {
      fbLoading.innerHTML = `
        <i class="fas fa-spinner fa-spin"></i>
        <span>Pobieranie postów z Facebooka...</span>
      `;
      
      // Jeśli nie używamy HTTPS, wyświetl komunikat i użyj domyślnych postów
      if (!isHttps) {
        console.warn('Facebook API wymaga HTTPS. Używanie domyślnych ID postów.');
        useDefaultPosts();
        return;
      }
      
      // Pobieranie postów za pomocą Facebook Graph API
      if (typeof FB !== 'undefined') {
        FB.api(
          `/${pageId}/posts`,
          'GET',
          {
            access_token: 'YOUR_FB_ACCESS_TOKEN', // Należy zastąpić rzeczywistym tokenem dostępu
            fields: 'id,full_picture,message,created_time',
            limit: 20 // Limit postów do pobrania
          },
          function(response) {
            if (response && !response.error) {
              // Filtruj tylko posty ze zdjęciami
              const postsWithImages = response.data.filter(post => post.full_picture);
              
              // Wyodrębnij ID postów
              const postIds = postsWithImages.map(post => {
                // ID postów w Graph API mają format "{page_id}_{post_id}"
                // Musimy wyodrębnić część po znaku "_"
                const idParts = post.id.split('_');
                return idParts.length > 1 ? idParts[1] : post.id;
              });
              
              // Zapisz ID postów w localStorage
              localStorage.setItem('facebookPostIds', JSON.stringify(postIds));
              localStorage.setItem('lastFacebookFetch', currentTime.toString());
              
              // Renderuj posty
              renderPosts(postIds);
            } else {
              console.error('Błąd podczas pobierania postów z Facebooka:', response ? response.error : 'Brak odpowiedzi');
              // Jeśli nie możemy pobrać postów, sprawdź czy mamy jakieś zapisane ID
              if (savedPostIds) {
                try {
                  const savedIds = JSON.parse(savedPostIds);
                  renderPosts(savedIds);
                } catch (error) {
                  console.error('Błąd podczas parsowania zapisanych ID postów:', error);
                  useDefaultPosts();
                }
              } else {
                useDefaultPosts();
              }
            }
          }
        );
      } else {
        // Jeśli SDK Facebooka nie jest dostępne, użyj domyślnych postów
        console.warn('Facebook SDK nie jest dostępne. Używanie domyślnych ID postów.');
        useDefaultPosts();
      }
    }
    
    // Funkcja używająca domyślnych ID postów
    function useDefaultPosts() {
      const defaultPostIds = [
        '1312658123772695', // Rzeczywiste ID posta - jeśli działa, zostaw; jeśli nie, zastąp własnym
        '101625296280259_120538447389944', // Inny format ID posta - zmień na własne
        '101625296280259_120538390723283'  // Inny format ID posta - zmień na własne
      ];

      // Wyświetl komunikat informacyjny w konsoli
      console.info('Używanie domyślnych ID postów Facebook. Aby dodać własne posty, użyj narzędzia pomocniczego /facebook-helper.html');
      
      // Wyświetl subtelny komunikat dla użytkownika
      const infoElement = document.createElement('div');
      infoElement.className = 'facebook-info-message';
      infoElement.innerHTML = '<small>Wyświetlane są przykładowe posty. Aby zobaczyć wszystkie posty, odwiedź naszą <a href="https://www.facebook.com/' + pageId + '" target="_blank">stronę Facebook</a>.</small>';
      
      // Dodaj komunikat przed kontenerem galerii
      const fbContainer = document.querySelector('.facebook-container');
      if (fbContainer) {
        fbContainer.parentNode.insertBefore(infoElement, fbContainer);
      }
      
      renderPosts(defaultPostIds);
    }
    
    // Funkcja renderująca posty
    function renderPosts(postIds) {
      // Jeśli nie ma postów, wyświetl komunikat
      if (!postIds || postIds.length === 0) {
        fbLoading.innerHTML = `
          <p>Nie znaleziono postów ze zdjęciami.</p>
          <p>Odwiedź naszą stronę, aby zobaczyć wszystkie zdjęcia:</p>
          <a href="https://www.facebook.com/${pageId}/photos" target="_blank" rel="noopener noreferrer" class="fb-link">
            <i class="fab fa-facebook"></i> Zdjęcia Łowiska Lipuś na Facebooku
          </a>
        `;
        return;
      }
      
      // Ukryj loader
      fbLoading.style.display = 'none';
      
      // Dodaj embedy postów do galerii
      postIds.forEach(postId => {
        const postContainer = document.createElement('div');
        postContainer.className = 'gallery-item facebook-post';
        
        // Utwórz element div dla embeda Facebooka
        const embedContainer = document.createElement('div');
        embedContainer.className = 'fb-post';
        embedContainer.setAttribute('data-href', `https://www.facebook.com/${pageId}/posts/${postId}`);
        embedContainer.setAttribute('data-width', '');
        embedContainer.setAttribute('data-show-text', 'true');
        
        // Dodaj kontener embeda do kontenera posta
        postContainer.appendChild(embedContainer);
        
        // Dodaj post do galerii
        fbGallery.appendChild(postContainer);
      });
      
      // Przetwórz nowo dodane embedy
      if (typeof FB !== 'undefined') {
        FB.XFBML.parse();
      }
      
      // Dodaj filtr dla postów z Facebooka, jeśli jeszcze nie istnieje
      const filterContainer = document.querySelector('.gallery-categories');
      if (!document.querySelector('[data-filter="facebook-post"]')) {
        const facebookFilter = document.createElement('button');
        facebookFilter.className = 'gallery-filter';
        facebookFilter.setAttribute('data-filter', 'facebook-post');
        facebookFilter.textContent = 'Facebook';
        filterContainer.appendChild(facebookFilter);
        
        // Aktualizacja filtrów
        updateFilters();
      }
    }
  }
  
  function updateFilters() {
    const filters = document.querySelectorAll('.gallery-filter');
    
    filters.forEach(filter => {
      filter.addEventListener('click', function() {
        // Usunięcie klasy active ze wszystkich filtrów
        filters.forEach(f => f.classList.remove('active'));
        
        // Dodanie klasy active do klikniętego filtra
        this.classList.add('active');
        
        const filterValue = this.getAttribute('data-filter');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        galleryItems.forEach(item => {
          if (filterValue === 'all' || item.classList.contains(filterValue)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }
  
  // Funkcja do filtrowania zdjęć
  document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.gallery-filter');
    
    filters.forEach(filter => {
      filter.addEventListener('click', function() {
        // Usunięcie klasy active ze wszystkich filtrów
        filters.forEach(f => f.classList.remove('active'));
        
        // Dodanie klasy active do klikniętego filtra
        this.classList.add('active');
        
        const filterValue = this.getAttribute('data-filter');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        galleryItems.forEach(item => {
          if (filterValue === 'all' || item.classList.contains(filterValue)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
    
    // Aktualizacja linku do Facebook
    const facebookMoreLink = document.getElementById('facebook-more-link');
    if (facebookMoreLink) {
      const pageId = 'Lowiskolipus'; // To samo ID co w funkcji loadFacebookPosts
      facebookMoreLink.href = `https://www.facebook.com/${pageId}/photos`;
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