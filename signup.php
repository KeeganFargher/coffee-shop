<?php
        session_start();

        include("php/DBConn.php");
        
        // Define variables and set to empty values
        $firstname = $lastname = $email = $password = "";
        $firstnameError = $lastnameError = $emailError = $passwordError = "";

        if (isset($_POST['submit'])) {

            // Validate the user's input
            if (empty($_POST["register-firstname"])) {
                $firstnameError = "First Name is Required";
            } else {
                $firstname = test_input($_POST["register-firstname"]);
            }

            if (empty($_POST["register-lastname"])) {
                $lastnameError = "Last Name is Required";
            } else {
                $lastname = test_input($_POST["register-lastname"]);
            }

            if (empty($_POST["register-email"])) {
                $emailError = "Email is Required";
            } else {
                $email = test_input($_POST["register-email"]);

                // Check if e-mail address is correct format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid Email Format";
                }
            }

            if (empty($_POST["register-password"])) {
                $passwordError = "Password is Required";
            } else {
                $password = test_input($_POST["register-password"]);
            }

            //  Don't continue from this point on if any fields aren't validated
            if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) ) {

                //  Checking if the email address already exists
                //  Using prepared statements to prevent SQL injection
                //  https://youtu.be/LC9GaXkdxF8?t=3285
                $sql = "SELECT * FROM tbl_User WHERE Email=?";
                $stmt = mysqli_stmt_init($db);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    $emailError = "Email Already Taken";
                } else {
                    $sql = "INSERT into tbl_User (FName, LName, Email, Password) VALUES (?, ?, ?, SHA(?))";
                    $stmt = mysqli_stmt_init($db);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $password);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    $_SESSION['userId'] = $row['ID'];
                    $_SESSION['firstName'] = $row['FName'];
                    $_SESSION['isSignedIn'] = true;
                    header("location: shop-home.php");
                }
            }

        }

        /* 
        Removes any bad things from the data
        https://www.w3schools.com/php/php_form_validation.asp
        */
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php") ?>
    <link href="css/login.css" rel="stylesheet" />

    <title>Grinder | Sign Up</title>
</head>

<body>
    <div class="login-html">
        <div class="signin-wrapper">
            <div class="signin-box" style="width: 700px">
                <h1 class="signin-title-primary text-center">GRINDER</h1>
                <h3 class="signin-title-secondary text-center">Sign Up</h3>

                <!-- BEGIN FORM -->
                <form action="" method="post" autocomplete="off">
                    <div class="form-group has-danger">
                        <div class="row">

                            <!-- First Name -->
                            <div class="col-12 col-sm-6">
                                <label for="register-firstname">First Name</label>
                                <input type="text" class="input-text form-control" name="register-firstname" value="<?php echo $firstname ?>" />
                                <div class="invalid-feedback mb-3">
                                    <?php echo $firstnameError ?>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-12 col-sm-6">
                                <label for="register-lastname">Last Name</label>
                                <input type="text" class="input-text form-control" name="register-lastname" value="<?php echo $lastname ?>" />
                                <div class="invalid-feedback  mb-3">
                                    <?php echo $lastnameError ?>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-12 col-sm-6">
                                <label for="register-email">Email</label>
                                <input type="text" class="input-text form-control" name="register-email" value="<?php echo $email ?>" />
                                <div class="invalid-feedback  mb-3">
                                    <?php echo $emailError ?>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-12 col-sm-6">
                                <label for="register-password">Password</label>
                                <input autocomplete="new-password" type="password" class="input-text form-control" name="register-password" />
                                <div class="invalid-feedback">
                                    <?php echo $passwordError ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Login Button -->
                    <div class="login-button">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">REGISTER</button>
                    </div>
                </form>
                <div class="text-center">
                    <p>
                        Copyright 2019 &copy; <a href="#" target="_blank">GRINDER</a><br />
                        Built by: <a href="https://github.com/KeeganFargher" target="_blank">Keegan Fargher</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>