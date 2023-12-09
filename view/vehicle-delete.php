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
    <title>
        <?php
        if (isset($invInfo['invMake'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        }
        ?> | PHP Motors
    </title>
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

        <div class="vehicle-head">
            <h1>
                <?php
                if (isset($invInfo['invMake'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                }
                ?>
            </h1>
            <p>Confirm Vehicle Deletion. This delete is permanent.</p>
        </div>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form method="post" action="/phpmotors/vehicles/" class="user-form">
            <fieldset>
                <legend>Delete Vehicle</legend>
                <label for="invMake">Vehicle Make<input type="text" name="invMake" id="invMake"
                        <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?> readonly>
                </label>
                <label for="invModel">Vehicle Model<input type="text" name="invModel" id="invModel"
                        <?php if (isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?> readonly>
                </label>
                <label for=" invDescription">Vehicle Description<textarea name="invDescription" id="invDescription"
                        cols="30" rows="2" readonly><?php if (isset($invInfo['invDescription'])) {
                            echo $invInfo['invDescription'];
                        } ?></textarea>
                </label>
            </fieldset>

            <input type="submit" name="submit" id="deleteVehicle" class="submitBtn" value="Delete Vehicle">
            <!-- Add the action name = value pair -->
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])) {echo $invInfo['invId'];} ?>">
        </form>

        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>