<?php

    /*
    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.
    */

    session_start();
    include_once("php/DBConn.php");
    include_once("php/shop-buy-script.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php"); ?>

    <title>Grinder | Shop Coffee</title>
</head>

<body>
    <!-- LOADING CIRCLE -->
    <div class="loader-background">
        <div class="loader">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <?php require("header.php"); ?>

    <!-- Light Roast Coffee -->
    <div class="container-white container-fluid">
        <h1 class="text-center line-under-text">SHOP LIGHT ROAST</h1>

        <div class="cart-items-container">
            <?php 
                generateShoppingTable(
                    $db,
                    "card text-white bg-primary mb-3",
                    "btn btn-outline-secondary button-card-white",
                    "",
                    "",
                    1);
            ?>
        </div>
    </div>

    <!-- Dark Roast Coffee -->
    <div class="container-black container-fluid">
        <h1 class="text-center line-under-text">SHOP DARK ROAST</h1>

        <div class="cart-items-container">
            <?php 
                generateShoppingTable(
                    $db,
                    "card border-primary mb-3",
                    "btn btn-primary button-card-black ",
                    "text-dark",
                    "text-grey",
                    2);
            ?>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal" id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">The Price of Your Item</h5>

                </div>
                <div class="modal-body">
                    <p id="price"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onClick="closeModal()">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <?php require("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/shop-buy.js"></script>


</body>

</html>