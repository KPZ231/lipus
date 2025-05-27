<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty | Łowisko Lipuś</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .posts-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .post {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        
        .post:hover {
            transform: translateY(-5px);
        }
        
        .post.important {
            border-left: 5px solid #ff6b6b;
            background-color: #fff9f9;
        }
        
        .post-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .post.important .post-title::before {
            content: "⚠️ ";
            color: #ff6b6b;
        }
        
        .post-date {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
            display: block;
        }
        
        .post-content {
            line-height: 1.6;
            color: #444;
        }
        
        .no-posts {
            text-align: center;
            padding: 50px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Skip to content link for accessibility -->
    <a href="#main-content" class="skip-link">Przejdź do treści</a>

    <!-- Navigation Bar -->
    <nav aria-label="Menu główne">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/gallery">Galeria</a></li>
        <li><a href="/posts" aria-current="page">Posty</a></li>
        <li><a href="/rules">Regulamin</a></li>
        <li><a href="/#prices">Cennik</a></li>
        <li><a href="/#about">O nas</a></li>
        <li><a href="/#contact">Kontakt</a></li>
      </ul>
      <!-- Mobile navigation toggle button will be added by JavaScript -->
    </nav>

    <!-- Header -->
    <header class="posts-header">
        <div class="container">
            <h1>Posty</h1>
            <p>Najnowsze informacje i ogłoszenia z naszego łowiska</p>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content">
        <div class="posts-container">
            <?php if (empty($posts)): ?>
                <div class="no-posts">
                    <i class="fas fa-info-circle"></i> Brak postów do wyświetlenia
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <article class="post <?php echo isset($post['important']) && $post['important'] ? 'important' : ''; ?>">
                        <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                        <time class="post-date">
                            <i class="far fa-calendar-alt"></i> 
                            <?php echo date('d.m.Y H:i', strtotime($post['created_at'])); ?>
                        </time>
                        <div class="post-content">
                            <?php echo nl2br(htmlspecialchars($post['content'] ?? '')); ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

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
                        <li><a href="/posts">Posty</a></li>
                        <li><a href="/privacy-policy">Polityka prywatności</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h4>Obserwuj nas</h4>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/lowiskolipus" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
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
</body>
</html> 