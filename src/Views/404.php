<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Nie znaleziono strony | Łowisko Lipus Bujaków</title>
    <meta name="robots" content="noindex, follow">
    <meta name="author" content="Łowisko wędkarskie Lipuś">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
        }
        header {
            margin-bottom: 40px;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #e74c3c;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #e74c3c;
            margin: 0;
            line-height: 1;
        }
        .message {
            font-size: 24px;
            margin: 20px 0 40px;
        }
        .back-home {
            display: inline-block;
            padding: 12px 30px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .back-home:hover {
            background-color: #c0392b;
        }
        .suggestions {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .suggestions h2 {
            color: #333;
            margin-top: 0;
        }
        .suggestions ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
            max-width: 400px;
            margin: 0 auto;
        }
        .suggestions li {
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
        }
        .suggestions li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="/">
                <img src="/assets/images/logo.png" alt="Lipus Logo" height="60">
            </a>
        </header>
        
        <div class="error-code">404</div>
        <h1>Strona nie znaleziona</h1>
        
        <p class="message">
            Przepraszamy, ale strona której szukasz nie istnieje lub została przeniesiona.
        </p>
        
        <a href="/" class="back-home">Wróć do strony głównej</a>
        
        <div class="suggestions">
            <h2>Co możesz zrobić?</h2>
            <ul>
                <li>Sprawdź, czy adres URL został wpisany poprawnie</li>
                <li>Wróć do poprzedniej strony</li>
                <li>Przejdź do strony głównej i spróbuj znaleźć potrzebne informacje</li>
                <li>Skorzystaj z menu nawigacyjnego, aby znaleźć odpowiednią sekcję</li>
            </ul>
        </div>
    </div>
    
    <!-- Structured data for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Strona 404 - Nie znaleziono | Łowisko Wędkarskie Lipuś",
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
        }
      }
    }
    </script>
</body>
</html> 