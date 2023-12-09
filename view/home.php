<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHPMotors</title>
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
        <section id="cta-head">
            <h1>Welcome to PHP Motors!</h1>
            <img src="/phpmotors/images/vehicles/delorean.jpg" alt="delorean">
            <div class="cta-content">
                <h2>DMC Delorean</h2>
                <p>Cup holders <br> Superman doors <br> Fuzzy dice!</p>
                <a href="#" class="cta-btn large">Own Today</a>
            </div>
            <div class="small">
                <a href="#" class="cta-btn small">Own Today</a>
            </div>
        </section>

        <div class="delorean-grid">
            <div class="delorean-right">
                <h2>DMC Delorean Reviews</h2>
                <ul class="dmc-reviews">
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I\'m feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80\'s livin and I love it!" (5/5)</li>
                </ul>
            </div>
            <div class="delorean-left">
                <h2>Delorean Upgrades</h2>
                <div class="upgrades-grid">
                    <div class="box">
                        <div class="box-head">
                            <img src="./images/upgrades/flux-cap.png" alt="flux-cap">
                        </div>
                        <div class="box-content">
                            <a href="">Flux Capacitor</a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-head">
                            <img src="./images/upgrades/flame.jpg" alt="flame">
                        </div>
                        <div class="box-content">
                            <a href="">Flame Decals</a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-head">
                            <img src="./images/upgrades/bumper_sticker.jpg" alt="bumper-sticker">
                        </div>
                        <div class="box-content">
                            <a href="">Bumper Stickers</a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-head">
                            <img src="./images/upgrades/hub-cap.jpg" alt="hub-cap">
                        </div>
                        <div class="box-content">
                            <a href="">Hub Caps</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </main>

    <script src="/phpmotors/scripts/script.js"></script>
</body>

</html>