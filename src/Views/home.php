<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
  <h1><?= htmlspecialchars($title) ?></h1>
  <p>Witaj, <?= htmlspecialchars($user) ?>!</p>
</body>
</html>
