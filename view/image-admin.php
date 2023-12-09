<?php if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management | PHPMotors</title>
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
        <div id="imageMan">
            <h1>Image Management</h1><br>
            <p>Choose one of the options below:</p>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>
            <form method="post" action="/phpmotors/uploads/" class="user-form" enctype="multipart/form-data">
                <fieldset>
                    <legend>Add New Vehicle Image</legend>
                    <label for="invItem">Vehicle</label>
                    <?php echo $prodSelect; ?>
                    <div>Is this the main image for the vehicle?</div>
                    <label class="sbs" for="priYes"><input type="radio" name="imgPrimary" id="priYes" value="1"
                            class="fff">Yes</label>
                    <label class="sbs" for="priNo"><input type="radio" name="imgPrimary" id="priNo" checked
                            value="0">No</label>
                    <label>Upload Image:<input type="file" name="file1"></label>
                </fieldset>
                <input type="submit" class="submitBtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>
            <hr><br><br>
            <h2>Existing Images</h2>
            <p class="danger">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
            <br><br>
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
<?php unset($_SESSION['message']); ?>