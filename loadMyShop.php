<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php

function loadShop()
{
    include_once('php/DBConn.php');

    $file = file_get_contents('data/myShop.sql');

    $split = explode(";", $file);
    for ($i = 0; $i < count($split) - 1; $i++) {
        $sql = $split[$i] . ";";

        echo "<p>";
        echo $db->query($sql) ? $sql : "There was an error: " . $db->error;
        echo "<hr/>";
        echo "</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php"); ?>

    <title>Grinder | Load Shop</title>
</head>

<body>
    <!-- LOADING CIRCLE -->
    <div class="loader-background">
        <div class="loader">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center line-under-text">Load My Shop</h1>

        <?php loadShop() ?>
    </div>

    <?php require("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="js/loader.js"></script>
    <script src="js/shop-buy.js"></script>

</body>

</html>