<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php") ?>

    <title>Grinder | Home</title>
</head>

<body>
    <?php require("header.php"); ?>

    <!-- FULL SCREEN BANNER -->
    <div class="full-screen-image">
        <div class="hero-text-box">
            <h1 class="mb-3">Instant coffee is dead. <br /> Take the plunge.</h1>
            <a class="btn btn-primary mr-0 mr-sm-2 mb-3 mb-sm-0 width-250px" href="shop-buy.php">I want coffee</a>
            <a class="btn btn-secondary width-250px" href="#">teach me how to grind</a>
        </div>
    </div>

    <!-- FEATURES SECTION-->
    <section class="section-features" id="features">
        <h1 class="text-center line-under-text">THE WORLD'S MOST LUXURIOUS COFFEE</h1>
        <p class="long-copy large-paragraph text-center mb-5">
            Hello, we’re Grinder &mdash; your one and only shop to get fresh coffee. We
            offer a wide selection of both ground and fresh coffee beans. Anything fresher
            than our coffee is still on the plant. Order today!
        </p>

        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-4 mb-4 section-icon-padding">
                    <i class="fal fa-infinity icon-big"></i>

                    <h3>Up to 365 days/year</h3>
                    <p>
                        We are constantly working around the clock to ensure you
                        get your coffee as soon as possible! Don't be surprised if
                        you hear us knocking on your door during your Sunday lunch.
                    </p>
                </div>
                <div class="col-12 col-md-4 mb-4 section-icon-padding">
                    <i class="fal fa-coffee icon-big"></i>

                    <h3>Pure blissful coffee</h3>
                    <p>
                        We are constantly working around the clock to ensure you
                        get your coffee as soon as possible! Don't be surprised if
                        you hear us knocking on your door during your Sunday lunch.
                    </p>
                </div>
                <div class="col-12 col-md-4 mb-4 section-icon-padding">
                    <i class="fal fa-shipping-fast icon-big"></i>

                    <h3>Country wide free delivery</h3>
                    <p>
                        We are constantly working around the clock to ensure you
                        get your coffee as soon as possible! Don't be surprised if
                        you hear us knocking on your door during your Sunday lunch.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <?php require("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
</body>

</html>