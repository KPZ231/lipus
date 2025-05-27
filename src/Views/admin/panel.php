<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora | Łowisko Lipuś</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-panel">
    <nav class="admin-nav">
        <div class="container">
            <h1><i class="fas fa-tachometer-alt"></i> Panel Administratora</h1>
            <a href="/admin/logout" class="btn-logout">Wyloguj się <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <i class="fas fa-fish"></i> Łowisko Lipuś
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="#dashboard" data-section="dashboard" class="active">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#regular-posts" data-section="regular-posts">
                        <i class="fas fa-file-alt"></i> Dodaj Post
                    </a>
                </li>
                <li>
                    <a href="#gallery-posts" data-section="gallery-posts">
                        <i class="fas fa-images"></i> Dodaj do Galerii
                    </a>
                </li>
                <li>
                    <a href="#prices" data-section="prices">
                        <i class="fas fa-tag"></i> Cennik
                    </a>
                </li>
                <li>
                    <a href="#existing-posts" data-section="existing-posts">
                        <i class="fas fa-list"></i> Wszystkie Posty
                    </a>
                </li>
                <li class="sidebar-divider"></li>
                <li>
                    <a href="/" target="_blank">
                        <i class="fas fa-home"></i> Strona Główna
                    </a>
                </li>
                <li>
                    <a href="/admin/logout">
                        <i class="fas fa-sign-out-alt"></i> Wyloguj się
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <!-- Dashboard Section -->
            <section id="dashboard" class="tab-content active">
                <div class="dashboard-header">
                    <h2>Panel zarządzania - Łowisko Lipuś</h2>
                    <p class="current-date"></p>
                </div>
                
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                        <div class="stat-content">
                            <h3>Posty tekstowe</h3>
                            <p class="stat-number" id="regularPostsCount">0</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-images"></i></div>
                        <div class="stat-content">
                            <h3>Posty galerii</h3>
                            <p class="stat-number" id="galleryPostsCount">0</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-tag"></i></div>
                        <div class="stat-content">
                            <h3>Aktualne ceny</h3>
                            <div class="price-summary" id="currentPrices">
                                <p>1 wędka: <span id="dashboardPrice1Wedka">-</span> zł</p>
                                <p>2 wędki: <span id="dashboardPrice2Wedki">-</span> zł</p>
                                <p>Grill: <span id="dashboardPriceGrill">-</span> zł</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-actions">
                    <h3>Szybkie akcje</h3>
                    <div class="action-buttons">
                        <a href="#" class="dashboard-btn" data-navigate="regular-posts">
                            <i class="fas fa-plus-circle"></i> Dodaj nowy post
                        </a>
                        <a href="#" class="dashboard-btn" data-navigate="gallery-posts">
                            <i class="fas fa-camera"></i> Dodaj zdjęcie do galerii
                        </a>
                        <a href="#" class="dashboard-btn" data-navigate="prices">
                            <i class="fas fa-money-bill"></i> Aktualizuj cennik
                        </a>
                        <a href="#" class="dashboard-btn" data-navigate="existing-posts">
                            <i class="fas fa-edit"></i> Zarządzaj postami
                        </a>
                    </div>
                </div>
                
                <div class="dashboard-recent">
                    <h3>Ostatnie posty</h3>
                    <div id="recentPosts" class="recent-posts">
                        <!-- Recent posts will be loaded here -->
                        <div class="loading-posts">
                            <i class="fas fa-spinner fa-spin"></i> Ładowanie...
                        </div>
                    </div>
                </div>
            </section>

            <!-- Regular Posts Tab -->
            <section id="regular-posts" class="admin-card tab-content">
                <h2><i class="fas fa-plus-circle"></i> Dodaj nowy post (tylko tekst)</h2>
                <form id="addRegularPostForm" class="post-form">
                    <div class="form-group">
                        <label for="postTitle"><i class="fas fa-heading"></i> Tytuł:</label>
                        <input type="text" id="postTitle" name="title" required placeholder="Wprowadź tytuł posta">
                    </div>
                    <div class="form-group">
                        <label for="postContent"><i class="fas fa-align-left"></i> Treść:</label>
                        <textarea id="postContent" name="content" required placeholder="Wprowadź treść posta" rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="postEventDate"><i class="fas fa-calendar-alt"></i> Data wydarzenia (opcjonalnie):</label>
                        <div class="date-time-inputs">
                            <input type="date" id="postEventDate" name="event_date" placeholder="Wybierz datę wydarzenia">
                            <input type="time" id="postEventTime" name="event_time" placeholder="Wybierz godzinę wydarzenia">
                        </div>
                        <small>Wybierz datę i godzinę jeśli post dotyczy przyszłego wydarzenia</small>
                    </div>
                    <div class="form-group checkbox-group">
                        <label for="postImportant">
                            <input type="checkbox" id="postImportant" name="important" value="true">
                            <i class="fas fa-exclamation-circle"></i> Ważny post
                        </label>
                        <small>Zaznacz, jeśli ten post ma być oznaczony jako ważny</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-primary"><i class="fas fa-plus"></i> Dodaj post</button>
                    </div>
                    <div id="regularPostError" class="error-message"></div>
                </form>
            </section>

            <!-- Gallery Posts Tab -->
            <section id="gallery-posts" class="admin-card tab-content">
                <h2><i class="fas fa-plus-circle"></i> Dodaj nowy post do galerii</h2>
                <form id="addGalleryPostForm" class="post-form">
                    <div class="form-group">
                        <label for="galleryTitle"><i class="fas fa-heading"></i> Tytuł:</label>
                        <input type="text" id="galleryTitle" name="title" required placeholder="Wprowadź tytuł zdjęcia">
                    </div>
                    <div class="form-group">
                        <label for="galleryCategory"><i class="fas fa-tag"></i> Kategoria:</label>
                        <select id="galleryCategory" name="category" required>
                            <option value="">-- Wybierz kategorię --</option>
                            <option value="landscape">Krajobrazy</option>
                            <option value="fish">Złowione ryby</option>
                            <option value="people">Wędkarze</option>
                            <option value="infrastructure">Infrastruktura</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="galleryDescription"><i class="fas fa-align-left"></i> Opis:</label>
                        <textarea id="galleryDescription" name="description" required placeholder="Wprowadź opis zdjęcia"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="galleryImage"><i class="fas fa-image"></i> Zdjęcie:</label>
                        <input type="file" id="galleryImage" name="image" accept="image/*" required>
                        <div id="galleryImagePreview" class="image-preview"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-primary"><i class="fas fa-plus"></i> Dodaj do galerii</button>
                    </div>
                    <div id="galleryPostError" class="error-message"></div>
                </form>
            </section>

            <!-- Prices Tab -->
            <section id="prices" class="admin-card tab-content">
                <h2><i class="fas fa-tag"></i> Aktualizacja cennika</h2>
                <form id="updatePricesForm" class="post-form">
                    <div class="form-group">
                        <label for="price1Wedka"><i class="fas fa-fish"></i> Cena za 1 wędkę (zł):</label>
                        <input type="number" id="price1Wedka" name="price1Wedka" required min="0" step="1">
                    </div>
                    <div class="form-group">
                        <label for="price2Wedki"><i class="fas fa-fish"></i><i class="fas fa-fish"></i> Cena za 2 wędki (zł):</label>
                        <input type="number" id="price2Wedki" name="price2Wedki" required min="0" step="1">
                    </div>
                    <div class="form-group">
                        <label for="priceGrill"><i class="fas fa-fire"></i> Cena za grill (zł):</label>
                        <input type="number" id="priceGrill" name="priceGrill" required min="0" step="1">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Aktualizuj cennik</button>
                    </div>
                    <div id="pricesError" class="error-message"></div>
                </form>
            </section>

            <!-- Existing Posts Tab -->
            <section id="existing-posts" class="admin-card tab-content">
                <h2><i class="fas fa-list"></i> Istniejące posty</h2>
                <div id="postsList" class="posts-grid">
                    <!-- Posts will be loaded here dynamically -->
                    <div class="no-posts" id="noPosts" style="display: none;">
                        <i class="fas fa-info-circle"></i> Brak postów do wyświetlenia
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Mobile menu toggle button -->
    <button id="sidebarToggle" class="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <script src="/assets/js/admin.js"></script>
</body>
</html> 