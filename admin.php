<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php") ?>

    <title>Grinder | Admin</title>
</head>

<body>
    <div class="loader-background">
        <div class="loader"></div>
    </div>

    <?php require("header.php"); ?>

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