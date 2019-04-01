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

    <title>Grinder | Admin</title>
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

    <div class="coming-soon-container">
        <div class="coming-soon-middle">
            <h1 class="text-white">COMING SOON</h1>
            <div class="line-under-text-white"></div>
        </div>
    </div>


    <!-- JAVASCRIPT REQUIRED -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
    <script src="js/loader.js"></script>
</body>

</html>