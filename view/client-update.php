<?php if (!isset($_SESSION['loggedin'])) {
    header('location: /phpmotors/');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management | PHPMotors</title>
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
        <h1>Manage Account</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <form method="post" action="/phpmotors/accounts/" class="user-form">
            <fieldset>
                <legend>Update Account</legend>
                <label for="clientFirstname">First Name<input type="text" name="clientFirstname" id="clientFirstname" <?php if (isset($clientFirstname)) 
                    {echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname']))
                    {echo "value='{$_SESSION['clientData']['clientFirstname']}'";} ?> required>
                </label>
                <label for="clientLastname">Last Name<input type="text" name="clientLastname" id="clientLastname" <?php if (isset($clientLastname))
                    {echo "value='$clientLastname'" ;} elseif(isset($_SESSION['clientData']['clientLastname']))
                    {echo "value='{$_SESSION['clientData']['clientLastname']}'" ;} ?> required>
                </label>
                <label for="clientEmail">Email<input type="email" name="clientEmail" id="clientEmail" <?php if (isset($clientEmail)) 
                    {echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail']))
                    {echo "value='{$_SESSION['clientData']['clientEmail']}'";} ?> required></label>
            </fieldset>

            <input type="submit" name="submit" id="updateBtn" class="submitBtn" value="Update Info">
            <!-- Add the action name = value pair -->
            <input type="hidden" name="action" value="updateInfo">
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])) {echo $_SESSION['clientData']['clientId'];} 
                elseif(isset($clientId)) { echo $clientId;} ?>">
        </form>

        <?php
        if (isset($_SESSION['message1'])) {
            echo $_SESSION['message1'];
        }
        ?>
        <form method="post" action="/phpmotors/accounts/" class="user-form">
            <fieldset>
                <legend>Update Password</legend>
                <small><b>note your original password will be changed.</b></small>
                <label for="clientPassword">Password<input type="password" name="clientPassword" id="clientPassword"
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        title="Password must contain at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character."
                        required></label>
            </fieldset>

            <input type="submit" name="submit" id="passwordBtn" class="submitBtn" value="Update Password">
            <!-- Add the action name = value pair -->
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])) {echo $_SESSION['clientData']['clientId'];} 
                elseif(isset($clientId)) { echo $clientId;} ?>">
        </form>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> </footer>
    </main>

    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); unset($_SESSION['message1']); ?>