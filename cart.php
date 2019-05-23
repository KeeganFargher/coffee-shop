<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    include_once("php/shoppingCart.php");
    session_start();

    if (isset($_SESSION["cart"])) {
        $cart = unserialize($_SESSION["cart"]);
        $cart->processUserInput();
    } else {
        $cart = new ShoppingCart;
        $cart->initializeCart();
    }
    $cart->loadItems();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("meta.php") ?>
    <link rel="stylesheet" href="css/toast.min.css">
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
        <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="table-heading" style="width: 15%">Image</th>
                    <th scope="col" class="table-heading">Name</th>
                    <th scope="col" class="table-heading">Sell Price</th>
                    <th scope="col" class="table-heading">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php $cart->getCart(); ?>

                <tr class="text-center">
                    <td class="table-heading"> Empty Cart </td>
                    <td colspan="2" class="table-heading">Your shopping cart contains 3 products.</td>
                    <td class="table-heading">Total: R23232</td>
                </tr>
        </table>
    </div>

    <?php include_once("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="js/toast.min.js"></script>
    <script src="js/toastroptions.js"></script>
    <script src="js/loader.js"></script>
    <?php 
        $_SESSION["cart"] = serialize($cart); 
        if ($cart->getToastMessage() != "") {
            echo
            "<script>
                toastr.success('{$cart->getToastMessage()}');
            </script>";
        }
    ?>
</body>

</html>