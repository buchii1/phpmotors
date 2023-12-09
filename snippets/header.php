<a href="/phpmotors"><img src="/phpmotors/images/site/logo.png" alt="phpMotors logo"></a>
<div class="header-main">
    <?php if (isset($_SESSION['loggedin'])) {
        echo "<a href='/phpmotors/accounts/' class='header-cookie'>{$_SESSION['clientData']['clientFirstname']}</a>";
        echo '<a href="/phpmotors/accounts/?action=logout">Logout</a>';
    } else {
        echo '<a href="/phpmotors/accounts/?action=login" title="Login to your user account">My Account</a>';
    }
    ?>
</div>