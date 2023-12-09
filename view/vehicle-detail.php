<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "{$inventory['invMake']} {$inventory['invModel']}"; ?> | PHPMotors</title>
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
        <?php if (isset($message)) {
            echo $message;
        } ?>
        <h1 class="vehicle-detail-h1">
            <?php echo "{$inventory['invMake']} {$inventory['invModel']}" ?>
        </h1>
        <small class="vehicle-detail-span">You can view/leave reviews at the bottom of the page.</small>
        <div id="v-detail-grid">
            <?php if (isset($inventoryDisplay)) {
                echo $inventoryDisplay;
            } ?>
            <?php if (isset($imagesDisplay)) {
                echo $imagesDisplay;
            } ?>
        </div>
        <hr>
        <div id="cus-reviews">
            <h2>Customer Reviews</h2>
            <?php if (isset($_SESSION['messages'])) {
                echo $_SESSION['messages'];
            } ?>
            <?php
            if (!isset($_SESSION['loggedin'])) {
                echo "You must <a href='/phpmotors/accounts/?action=login'>login</a><span> to write a review.</span>";
                echo "<br><br><br>";
            } else {
                $initial = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
                $name = $initial . $_SESSION['clientData']['clientLastname'];

                echo "<form method='post' action='/phpmotors/reviews/' class='user-form'>
                    <fieldset>
                        <legend>Add Review</legend>
                        <label for='clientName'>Screen Name<input type='text' name='clientName' id='clientName' value='$name' readonly></label>
                        <label for='reviewText'>Review<textarea name='reviewText' id='reviewText' cols='30' rows='2' required>";
                if (isset($reviewText)) {
                    echo $reviewText;
                }
                echo "</textarea></label>
                    </fieldset>
                    <input type='submit' name='submit' id='addReview' class='submitBtn' value='Add Review'>
                    <!-- Add the action name = value pair -->
                    <input type='hidden' name='action' value='add-review'>
                    <input type='hidden' name='invId' value='{$inventory['invId']}'>
                    <input type='hidden' name='clientId' value='{$_SESSION['clientData']['clientId']}'>
                    </form>";
            }

            // Display a message if there are no reviews
            if (isset($_SESSION['loggedin']) && count($reviews) < 1) {
                echo "<p class='cus-reviews-p'>Be the first to write a review.</p>";
            }

            // Display the reviews HTML
            if (isset($reviewsDisplay)) {
                if ($count >= 1) {
                    if ($count == 1) {
                        $r = "Review";
                    } else {
                        $r = "Reviews";
                    }
                    echo "<h2 class='review-h2'><span>&nbsp;&nbsp;&nbsp;</span> $count $r</h2>";
                }
                echo "$reviewsDisplay";
            }
            ?>
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
<?php unset($_SESSION['messages']); ?>