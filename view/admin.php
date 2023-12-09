<?php if (!isset($_SESSION['loggedin'])) {
    header("Location: /phpmotors/");
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHPMotors</title>
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
            <h1>
                <?php
                echo "{$_SESSION['clientData']['clientFirstname']} {$_SESSION['clientData']['clientLastname']}";
                ?>
            </h1>
            <p>You are logged in.</p>
            <?php if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            } ?>
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'] ?>
                </li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
                <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
            </ul>
            <h2>Account Management</h2>
            <p>Use this link to update account information.</p>
            <a href="/phpmotors/accounts?action=update&clientId=<?php echo "{$_SESSION['clientData']['clientId']}"; ?>">
                Update Account Information
            </a>
            <br><br>
            <h2>Reviews Management</h2>
            <p>Modify / Delete Reviews.</p>
            <?php if (isset($_SESSION['message1'])) {
                echo $_SESSION['message1'];
            } ?>
            <?php if (isset($reviewsDisplay)) {
                echo "$reviewsDisplay"; } ?>
            <br><br>
            <?php if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<h2>Inventory Management</h2>';
                echo '<p>Use the link below to manage the inventory.</p>';
                echo '<a href="/phpmotors/vehicles/">Vehicle Management</a>';
            } ?>
        </div> <br>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); unset($_SESSION['message1']); ?>