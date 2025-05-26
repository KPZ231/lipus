<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Logowanie | Łowisko Lipuś</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-login">
    <div class="login-container">
        <div class="login-box">
            <h1>Panel Administratora</h1>
            <form id="loginForm" class="login-form">
                <div class="form-group">
                    <label for="username">Login:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary">Zaloguj się</button>
                </div>
                <div id="loginError" class="error-message" style="display: none;"></div>
            </form>
        </div>
    </div>
    <script src="/assets/js/admin.js"></script>
</body>
</html> 