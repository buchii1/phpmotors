<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $classificationName; ?> vehicles | PHPMotors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
</head>

<body>
    <main>
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php echo $navigation; ?>
        </nav>
        <div id="classification">
            <h1><?php echo $classificationName; ?> vehicles</h1>
            <div id="classification-main">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
                <?php if (isset($vehicleDisplay)) {
                    echo $vehicleDisplay;
                } ?>
            </div>
        </div>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="/phpmotors/scripts/script.js"></script>
</body>

</html>