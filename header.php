<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php

$cartCount = isset($_SESSION['cartCount']) ? $_SESSION['cartCount'] : 0;

function getRedirectUrl() {
    return ('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

function logout() {
    session_destroy();
    header("Location: index.php");
}

?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Grinder</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarExpansion"
            aria-controls="navbarExpansion" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarExpansion">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="shop-buy.php">Shop Now</a>
                </li>
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class='text-center cart-container mr-0 mr-lg-4' onmouseover="cartHover()">
                    <a href='cart.php'>
                        <i class="fas fa-shopping-cart"></i>
                        <p id="cart-counter" class="cart-counter"><?php echo $cartCount ?></p>
                    </a>
                </li>

                <?php if (isset($_SESSION['isSignedIn']) && $_SESSION['isSignedIn'] === true) { ?>
                <!-- Display this if you are logged in -->
                <li class='text-center text-lg-right mb-2 mb-sm-0'>
                    <a href='#' class='mr-0 mr-lg-4'>Welcome <?php echo $_SESSION["firstName"] ?></a>
                </li>
                <li class='text-center text-lg-right'>
                    <a href='login.php' class='mr-0 mr-lg-4'>Logout</a>
                </li>
                <?php } else { ?>
                <!-- Display this if you are NOT logged in -->
                <li class='text-center text-lg-right'>
                    <a href='login.php?redirect_url=<?php echo getRedirectUrl(); ?>' class='mr-0 mr-lg-4'>Login</a>
                </li>
                <li class='text-center text-lg-right'>
                    <a href='signup.php' class='mr-0 mr-lg-4'>Sign Up</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<script>
    function cartHover() {
        console.log('yop');
    }
</script>