<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora | Łowisko Lipuś</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-panel {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding-bottom: 3rem;
        }

        .admin-nav {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .admin-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-nav h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-logout:hover {
            background-color: #c82333;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .add-post-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .add-post-section h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .post-form {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 500;
            color: #444;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(22, 160, 133, 0.1);
        }

        .form-group input[type="file"] {
            padding: 0.5rem;
            border: 2px dashed #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .form-group input[type="file"]:hover {
            border-color: var(--secondary-color);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            width: fit-content;
        }

        .btn-primary:hover {
            background-color: #148f77;
            transform: translateY(-1px);
        }

        .image-preview {
            margin-top: 1rem;
            max-width: 300px;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .image-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        .posts-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .posts-section h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .posts-grid {
            display: grid;
            gap: 1.5rem;
        }

        .post-item {
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .post-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .post-item img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }

        .post-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .post-info h3 {
            margin: 0 0 0.5rem;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .post-info .category {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .post-info .description {
            color: #666;
            margin-bottom: 1rem;
            flex: 1;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            width: fit-content;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .error-message {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            display: none;
        }

        .error-message.error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .error-message.success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        @media (max-width: 768px) {
            .post-item {
                flex-direction: column;
            }

            .post-item img {
                width: 100%;
                height: 200px;
            }

            .admin-nav .container {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .btn-logout {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
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
                    <label for="category">Kategoria:</label>
                    <select id="category" name="category" required>
                        <option value="landscape">Krajobrazy</option>
                        <option value="fish">Złowione ryby</option>
                        <option value="people">Wędkarze</option>
                        <option value="infrastructure">Infrastruktura</option>
                    </select>
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
                <div id="postError" class="error-message"></div>
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