<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error | PHPMotors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
</head>

<body>
    <main>
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?>
        </nav>
        <h1>Server Error</h1>
        <p>Sorry our server seems to be experiencing some technical difficulties.</p>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <script src="/phpmotors/scripts/script.js"></script>
</body>

</html>