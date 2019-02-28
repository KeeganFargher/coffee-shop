<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

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
                    <a class="nav-link" href="shop-home.php">Home</a>
                </li>
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="shop-buy.php">Shop Now</a>
                </li>
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if (isset($_SESSION['isSignedIn']) && $_SESSION['isSignedIn'] === true) {
                        echo 
                        "<li class='text-center text-lg-right'><a href='#' class='mr-0 mr-lg-4 mb-3 mb-sm-0'>Welcome " . $_SESSION["firstName"] ."</a></li>
                        <li class='text-center text-lg-right'><a href='index.php' class='mr-0 mr-lg-4'>Logout</a></li>";
                    } else {
                        echo 
                        "<li class='text-center text-lg-right'><a href='index.php' class='mr-0 mr-lg-4'>Login</a></li>
                        <li class='text-center text-lg-right'><a href='signup.php' class='mr-0 mr-lg-4'>Sign Up</a></li>";
                    }
                ?>

            </ul>
        </div>
    </div>
</nav>