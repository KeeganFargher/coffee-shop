<?php
        session_unset();
        session_start();

        include("php/DBConn.php");
        //include("php/createTable.php");

        // Define variables and set to empty values
        $email = $password = $error = "";

        if (isset($_POST['submit'])) {

            // Getting email and password
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            $sql = "SELECT ID, FName, LName FROM tbl_user WHERE email = '$email' and password = SHA('$password')";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();

            $count = mysqli_num_rows($result);

            // If result matched, table row must be 1 row
            if($count == 1) {
                $_SESSION['userId'] = $row['ID'];
                $_SESSION['firstName'] = $row['FName'];
                $_SESSION['isSignedIn'] = true;

                $error = "";

                header("location: shop-home.php");
            } else {
                $error = "Incorrect Email and/or Password";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php") ?>
    <link href="css/login.css" rel="stylesheet" />

    <title>Grinder | Login</title>
</head>

<body>

    <div class="loader-background">
        <div class="loader"></div>
    </div>

    <div class="login-html">
        <div class="signin-wrapper">
            <div class="signin-box">
                <h1 class="signin-title-primary text-center">GRINDER</h1>
                <h3 class="signin-title-secondary text-center">Sign in to continue.</h3>

                <!-- BEGIN FORM -->
                <form action="" method="post">
                    <div class="form-group">

                        <!-- Email -->
                        <label for="username">Email</label>
                        <input type="text" class="input-text form-control mb-3" name="email" value="<?php echo $email ?>" />

                        <!-- Password -->
                        <label for="password">Password</label>
                        <input type="password" class="input-text form-control" name="password" />

                        <div class="invalid-feedback">
                            <?php echo $error ?>
                        </div>

                        <!-- Login Button -->
                        <div class="login-button">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">LOGIN</button>
                        </div>
                </form>
                <div class="text-center">
                    <p>
                        Not Yet a Member? <a href="signup.php">Sign Up.</a><br /><br />

                        Copyright 2019 &copy; <a href="https://github.com/KeeganFargher/coffee-shop" target="_blank">GRINDER</a><br />
                        Built by: <a href="https://github.com/KeeganFargher" target="_blank">Keegan Fargher</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- JAVASCRIPT REQUIRED -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
<script src="js/loader.js"></script>

</html>