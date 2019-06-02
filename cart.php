<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    session_start();
    include_once("php/shoppingCart.php");

    if (isset($_SESSION["cart"])) {
        $cart = unserialize($_SESSION["cart"]);
        $cart->loadItems();
        $cart->processUserInput();
    } else {
        $cart = new ShoppingCart();
        $cart->loadItems();
        $cart->initializeCart();
        $cart->processUserInput();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("meta.php") ?>
    <link rel="stylesheet" href="css/toast.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
    <title>Grinder | Cart</title>
</head>

<body>
    <!-- LOADING CIRCLE -->
    <div class="loader-background">
        <div class="loader">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <?php include_once("header.php"); ?>


    <div class="container container-table mb-5">
        <h2 class="text-center line-under-text">Your Cart</h2>
        <div class="row">
            <div class="col-9">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="table-heading text-center" style="width: 15%">Image</th>
                            <th scope="col" class="table-heading">Name</th>
                            <th scope="col" class="table-heading text-center">Quantity</th>
                            <th scope="col" class="table-heading text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cart->getCart(); ?>
                </table>
            </div>
            <div class="col-3">
                <?php $cart->getCartSummary(); ?>
            </div>
        </div>
    </div>

    <?php include_once("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="js/toast.min.js"></script>
    <script src="js/toastroptions.js"></script>
    <script src="js/loader.js"></script>
    <?php 
        $_SESSION["cart"] = serialize($cart); 

        echo $cart->getToastMessage();
    ?>
</body>

</html>