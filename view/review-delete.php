<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: /phpmotors/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete <?php
                                if (isset($reviewInfo['invMake']) && isset($reviewInfo['invModel'])) {
                                    echo "$reviewInfo[invMake] $reviewInfo[invModel]";
                                } ?>
        Review | PHPMotors</title>
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
        <div class="review-head">
            <h1>
                <?php
                if (isset($reviewInfo['invMake']) && isset($reviewInfo['invModel'])) {
                    echo "Delete $reviewInfo[invMake] $reviewInfo[invModel] Review";
                } ?>
            </h1>
            <p>Reviewed on <?php echo $date ?></p>
            <small class="star">Deleting of a review cannot be undone.</small>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <form method='post' action='/phpmotors/reviews/' class='user-form'>
            <fieldset>
                <legend>Delete Review</legend>
                <label for='reviewText'>Review<textarea name='reviewText' id='reviewText' cols='30' rows='2'
                        readonly> <?php if (isset($reviewInfo['reviewText'])) {
                                                                                                                                echo $reviewInfo['reviewText'];
                                                                                                                            } ?></textarea></label>
            </fieldset>
            <input type='submit' name='submit' id='delReview' class='submitBtn' value='Delete Review'>
            <!-- Add the action name = value pair -->
            <input type='hidden' name='action' value='deleteReview'>
            <input type='hidden' name='reviewId' value=" <?php if (isset($reviewInfo['reviewId'])) {
                                                                echo $reviewInfo['reviewId'];
                                                            } ?>">
            <input type='hidden' name='clientId' value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                            echo $_SESSION['clientData']['clientId'];
                                                        } ?>">
        </form>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src=" /phpmotors/scripts/script.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>