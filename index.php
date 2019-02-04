<?php
        session_start();

        include("php/createTable.php");
        include("php/DBConn.php");
        
        // Define variables and set to empty values
        $email = $password = $error = "";

        if (isset($_POST['submit'])) {

            // Getting email and password
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            $sql = "SELECT ID, FName, LName FROM tbl_User WHERE email = '$email' and password = SHA('$password')";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            //$active = $row['active'];

            $count = mysqli_num_rows($result);

            // If result matched, table row must be 1 row
            if($count == 1) {
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
                        Not Yet a Member? <a href="#">Sign Up.</a><br /><br />

                        Copyright 2019 &copy; <a href="#" target="_blank">GRINDER</a><br />
                        Built by: <a href="https://github.com/KeeganFargher" target="_blank">Keegan Fargher</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>