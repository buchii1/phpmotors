<?php
    if (!isset($_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel']) < 2) {
        header("Location: /phpmotors/");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification | PHPMotors</title>
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
        <form method="post" action="/phpmotors/vehicles/" class="user-form">
            <fieldset>
                <legend>Add Classification</legend>
                <label for="classificationName">Classification Name<input type="text" name="classificationName"
                        id="classificationName" maxlength="30"
                        <?php if (isset($classificationName)) {
                                                                                                                                                                        echo "value='$classificationName'";
                                                                                                                                                                    } ?>
                        title="Input should be no more than 30 characters." required>
                </label>
            </fieldset>

            <input type="submit" name="submit" id="addClassification" class="submitBtn" value="Add Classification">
            <!-- Add the action name = value pair -->
            <input type="hidden" name="action" value="newClassification">
        </form>

        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="/phpmotors/scripts/script.js"></script>
</body>

</html>