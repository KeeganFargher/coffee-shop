<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("meta.php") ?>

    <title>Grinder | Home</title>
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

    <!-- FULL SCREEN BANNER -->
    <div class="full-screen-image">
        <div class="hero-text-box">
            <h1 class="mb-3">Instant coffee is dead. <br /> Take the plunge.</h1>
            <a class="btn btn-primary mr-0 mr-sm-2 mb-3 mb-sm-0 width-250px" href="shop-buy.php">I want coffee</a>
            <a class="btn btn-secondary width-250px js--scroll-to-start" href="#">teach me how to grind</a>
        </div>
    </div>

    <!-- FEATURES SECTION-->
    <section class="section-features js--section-features" id="features">
        <h1 class="text-center line-under-text">THE WORLD'S MOST LUXURIOUS COFFEE</h1>
        <p class="long-copy large-paragraph text-center mb-5">
            Hello, we’re Grinder &mdash; your one and only shop to get fresh coffee. We
            offer a wide selection of both ground and fresh coffee beans. Anything fresher
            than our coffee is <a
                href="https://www.theroasterie.com/blog/coffee-101-what-does-a-coffee-plant-look-like/">still
                a
                cherry.</a>
            Order today.
        </p>

        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-4 mb-4 section-icon-padding">
                    <i class="fa fa-infinity icon-big"></i>

                    <h3>Up to 365 days/year</h3>
                    <p>
                        We are constantly working around the clock to ensure you
                        get your coffee as soon as possible! Don't be surprised if
                        you hear us knocking on your door during your Sunday lunch.
                    </p>
                </div>
                <div class="col-12 col-md-4 mb-4 section-icon-padding">
                    <i class="fa fa-coffee icon-big"></i>

                    <h3>Pure blissful coffee</h3>
                    <p>
                        We ensure that our suppliers produce only the finest coffee
                        beans. Each batch is hand checked and extensive research is
                        done to ensure it comes from a single origin.
                    </p>
                </div>
                <div class="col-12 col-md-4 mb-4 section-icon-padding">
                    <i class="fa fa-shipping-fast icon-big"></i>

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

    <!-- TESTIMONIAL SECTION -->
    <section class="section-testimonials" id="testimonial">
        <div class="container">
            <h2 class="text-center line-under-text-white">Our customers can't live without us</h2>
            <div class="row">
                <div class="col-12 col-sm-4">
                    <blockquote>
                        Grinder is just awesome! I just launched a startup
                        which leaves me with no time shopping for coffee, so Grinder is
                        a life-saver. Now that I got used ordering online, I couldn't live
                        without my daily cup!
                        <cite><img src="img/customer-1.jpg" alt="Customer Picture" />Alberto
                            Duncan</cite>
                    </blockquote>
                </div>
                <div class="col-12 col-sm-4">
                    <blockquote>
                        Inexpensive, single-origin and great-tasting coffee, delivered
                        right to my home. We have lots of coffee delivery here in
                        Cape Town, but no one comes even close to Grinder. Me and
                        my family are so in love!
                        <cite><img src="img/customer-2.jpg" alt="Customer Picture" />Joana
                            Silva</cite>
                    </blockquote>
                </div>
                <div class="col-12 col-sm-4">
                    <blockquote>
                        I was looking for a quick and easy coffee delivery service
                        in Cape Town. I tried a lot of them and ended up with
                        Grinder. Best coffee delivery service in the country.
                        Keep up the great work!
                        <cite><img src="img/customer-3.jpg" alt="Customer Picture" />Milton
                            Chapman</cite>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT US SECTION -->
    <section class="section-form">
        <div class="container">
            <h2 class="text-center line-under-text">We're happy to hear from you</h2>

            <form method="POST" action="https://formspree.io/fargherkeegan@gmail.com" class="contact-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input class="form-control" name="name" placeholder="Enter Full Name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>

                <div class="form-group">
                    <label for="findus">How Did You Find Us?</label>
                    <select class="form-control" id="findus">
                        <option value="Friends" selected>Friends</option>
                        <option value="Other">Other</option>
                        <option value="Ad">Advertisement</option>
                        <option value="Search-engine">Search engine</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="textarea">Drop us a Line</label>
                    <textarea class="form-control" id="textarea" rows="3" name="message"></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="Send">

            </form>
        </div>
        </div>

    </section>

    <?php include_once("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="js/loader.js"></script>
    <script src="js/main.js"></script>
</body>

</html>