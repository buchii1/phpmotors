<?php 
    if (!isset($_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel']) < 2) {
        header("Location: /phpmotors/");
        exit;
    }

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHPMotors</title>
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
        <div class="vehicle-man">
            <h1>Vehicle Management</h1>
            <ul>
                <li><a href="/phpmotors/vehicles/index.php?action=class-page">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=vehicle-page">Add Vehicle</a></li>
            </ul>
            <?php 
            if (isset($message)) {
                echo $message;
            }
            echo '<br><br><br>';
            if (isset($classificationList)) {
                echo '<h2>Vehicles By Classification</h2>';
                echo '<p>Choose a classification to see those vehicles</p>';
                echo $classificationList;
            }
            ?>
        </div>
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <div class="vehicle-man--table">
            <table id="inventoryDisplay"></table>
        </div>
        <script src="../scripts/inventory.js"></script>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <script src="/phpmotors/scripts/script.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>