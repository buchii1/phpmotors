<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHPMotors</title>
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

        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <form method="post" action="/phpmotors/accounts/" class="user-form">
            <fieldset>
                <legend>Sign In</legend>
                <label for="clientEmail">Email<input type="email" name="clientEmail" id="clientEmail"
                        <?php if (isset($clientEmail)) {echo "value='$clientEmail'";}?> required></label>
                <label for="clientPassword">Password<input type="password" name="clientPassword" id="clientPassword"
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        title="Please enter at least 8 alphanumeric characters" required></label>
            </fieldset>

            <input type="submit" class="submitBtn" value="Sign in">
            <input type="hidden" name="action" value="Login">
        </form>
        <div class="account-footer">
            No account? <a href="/phpmotors/accounts/?action=registration">Create an account</a>
        </div>

        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> </footer>
    </main>

    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>