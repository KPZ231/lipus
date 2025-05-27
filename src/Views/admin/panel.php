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

    <main class="container">
        <section class="admin-card">
            <h2><i class="fas fa-plus-circle"></i> Dodaj nowy post</h2>
            <form id="addPostForm" class="post-form">
                <div class="form-group">
                    <label for="title"><i class="fas fa-heading"></i> Tytuł:</label>
                    <input type="text" id="title" name="title" required placeholder="Wprowadź tytuł posta">
                </div>
                <div class="form-group">
                    <label for="category"><i class="fas fa-tag"></i> Kategoria:</label>
                    <select id="category" name="category" required>
                        <option value="">-- Wybierz kategorię --</option>
                        <option value="landscape">Krajobrazy</option>
                        <option value="fish">Złowione ryby</option>
                        <option value="people">Wędkarze</option>
                        <option value="infrastructure">Infrastruktura</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Opis:</label>
                    <textarea id="description" name="description" required placeholder="Wprowadź opis posta"></textarea>
                </div>
                <div class="form-group checkbox-group">
                    <label for="important">
                        <input type="checkbox" id="important" name="important" value="true">
                        <i class="fas fa-exclamation-circle"></i> Ważny post
                    </label>
                    <small>Zaznacz, jeśli ten post ma być oznaczony jako ważny</small>
                </div>
                <div class="form-group">
                    <label for="image"><i class="fas fa-image"></i> Zdjęcie:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <div id="imagePreview" class="image-preview"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary"><i class="fas fa-plus"></i> Dodaj post</button>
                </div>
                <div id="postError" class="error-message"></div>
            </form>
        </section>

        <section class="admin-card">
            <h2><i class="fas fa-list"></i> Istniejące posty</h2>
            <div id="postsList" class="posts-grid">
                <!-- Posts will be loaded here dynamically -->
                <div class="no-posts" id="noPosts" style="display: none;">
                    <i class="fas fa-info-circle"></i> Brak postów do wyświetlenia
                </div>
            </div>
        </section>
    </main>

    <script src="/assets/js/admin.js"></script>
</body>
</html> 