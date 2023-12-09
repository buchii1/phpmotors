<?php
if (!isset($_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel']) < 2) {
    header("Location: /phpmotors/");
    exit;
}
// Build a car classification list using the $classifications array
$classificationList = '<select id="carClassification" name="carClassification">';
$classificationList .= "<option value='' selected disabled>Choose a Car Classification</option>";

foreach ($classifications as $carClass) {
    $classificationList .= "<option value='$carClass[classificationId]'";
    if (isset($classificationId)) {
        if ($carClass['classificationId'] == $classificationId) {
            $classificationList .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($carClass['classificationId'] == $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$carClass[classificationName]</option>";
}

$classificationList .= "</select>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invMode)) {
            echo "Modify $invMake $invModel";
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
                if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invMode)) {
                    echo "Modify $invMake $invModel";
                }
                ?>
            </h1>
        </div>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form method="post" action="/phpmotors/vehicles/" class="user-form">
            <fieldset>
                <legend>Modify Vehicle</legend>
                <?php echo $classificationList; ?>
                <label for="invMake">Make<input type="text" name="invMake" id="invMake" <?php if (isset($invMake)) {
                    echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";} ?>
                        required>
                </label>
                <label for="invModel">Model<input type="text" name="invModel" id="invModel"
                        <?php if (isset($invModel)) {
                    echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";} ?> required>
                </label>
                <label for=" invDescription">Description<textarea name="invDescription" id="invDescription" cols="30"
                        rows="2" required><?php if (isset($invDescription)) 
                        { echo $invDescription;} elseif (isset($invInfo['invDescription'])) {
                            echo $invInfo['invDescription'];
                        } ?></textarea>
                </label>
                <label for="invImage">Image Path<input type="text" name="invImage" id="invImage"
                        value="/phpmotors/images/no-image.png" <?php if (isset($invImage)) 
                    { echo "value='$invImage'";} elseif (isset($invInfo['invImage'])) {
                        echo "value='$invInfo[invImage]'";
                    } ?>required>
                </label>
                <label for="invThumbnail">Thumbnail Path<input type="text" name="invThumbnail" id="invThumbnail"
                        value="/phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) 
                        { echo "value='$invThumbnail'";} elseif (isset($invInfo['invThumbnail'])) {
                            echo "value='$invInfo[invThumbnail]'";
                        } ?> required>
                </label>
                <label for="invPrice">Price<input type="number" step="any" name="invPrice" id="invPrice" <?php if (isset($invPrice)) 
                    { echo "value='$invPrice'";} elseif (isset($invInfo['invPrice'])) {
                        echo "value='$invInfo[invPrice]'";
                    } ?> required>
                </label>
                <label for="invStock"># In Stock<input type="number" step="any" name="invStock" id="invStock" <?php if (isset($invStock)) {
                    echo "value='$invStock'";} elseif (isset($invInfo['invStock'])) {
                        echo "value='$invInfo[invStock]'";
                    } ?> required>
                </label>
                <label for="invColor">Color<input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {
                    echo "value='$invColor'";} elseif (isset($invInfo['invColor'])) {
                        echo "value='$invInfo[invColor]'";
                    } ?> required>
                </label>
            </fieldset>

            <input type="submit" name="submit" id="updateVehicle" class="submitBtn" value="Update Vehicle">
            <!-- Add the action name = value pair -->
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])) {echo $invInfo['invId'];}
                elseif(isset($invId)){echo $invId;} ?>">
        </form>

        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>