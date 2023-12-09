<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PHPMotors</title>
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
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form method="post" action="/phpmotors/accounts/" class="user-form">
            <fieldset>
                <legend>Sign Up</legend>
                <label for="clientFirstname">First Name<input type="text" name="clientFirstname" id="clientFirstname"
                        <?php if (isset($clientFirstname)) {echo "value='$clientFirstname'";} ?> required>
                </label>
                <label for="clientLastname">Last Name<input type="text" name="clientLastname" id="clientLastname"
                        <?php if (isset($clientLastname)) {echo "value='$clientLastname'";} ?> required>
                </label>
                <label for="clientEmail">Email<input type="email" name="clientEmail" id="clientEmail"
                        <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} ?> required></label>
                <label for="clientPassword">Password<input type="password" name="clientPassword" id="clientPassword"
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        title="Please enter at least 8 alphanumeric characters." required></label>
            </fieldset>

            <input type="submit" name="submit" id="regBtn" class="submitBtn" value="Create account">
            <!-- Add the action name = value pair -->
            <input type="hidden" name="action" value="register">
        </form>
        <div class="account-footer">
            Already have an account? <a href="/phpmotors/accounts/?action=login">Sign In</a>
        </div>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> </footer>
    </main>

    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>