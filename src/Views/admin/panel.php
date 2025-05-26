<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora | Łowisko Lipuś</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-panel">
    <nav class="admin-nav">
        <div class="container">
            <h1>Panel Administratora</h1>
            <a href="/admin/logout" class="btn-logout">Wyloguj się <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <main class="container">
        <section class="add-post-section">
            <h2>Dodaj nowy post</h2>
            <form id="addPostForm" class="post-form">
                <div class="form-group">
                    <label for="title">Tytuł:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Zdjęcie:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <div id="imagePreview" class="image-preview"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary">Dodaj post</button>
                </div>
                <div id="postError" class="error-message" style="display: none;"></div>
            </form>
        </section>

        <section class="posts-section">
            <h2>Istniejące posty</h2>
            <div id="postsList" class="posts-grid">
                <!-- Posts will be loaded here dynamically -->
            </div>
        </section>
    </main>

    <script src="/assets/js/admin.js"></script>
</body>
</html> 