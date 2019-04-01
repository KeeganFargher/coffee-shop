<?php
    session_start();
    
    // Define variables and set to empty values
    $firstname = $lastname = $email = $password = "";
    $firstnameError = $lastnameError = $emailError = $passwordError = "";

    if (isset($_POST['submit'])) {

        // Validate First Name
        if (empty($_POST["register-firstname"])) {
            $firstnameError = "First Name is Required";
        } else {
            $firstname = test_input($_POST["register-firstname"]);
        }

        // Validate Last Name
        if (empty($_POST["register-lastname"])) {
            $lastnameError = "Last Name is Required";
        } else {
            $lastname = test_input($_POST["register-lastname"]);
        }

        // Validate Email
        if (empty($_POST["register-email"])) {
            $emailError = "Email is Required";
        } else {
            $email = test_input($_POST["register-email"]);

            // Check if e-mail address is correct format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid Email Format";
            }
        }

        // Validate Password
        if (empty($_POST["register-password"])) {
            $passwordError = "Password is Required";
        } else {
            $password = test_input($_POST["register-password"]);
        }

        // Don't continue from this point on if any fields aren't validated
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) ) {

            // Checking if the email address already exists
            // Using prepared statements to prevent SQL injection
            // https://youtu.be/LC9GaXkdxF8?t=3285
            $sql = "SELECT * FROM tbl_user WHERE Email=?";
            $stmt = mysqli_stmt_init($db);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                $emailError = "Email Already Taken";
            } else {
                // SHA over MD5 because MD5 is no longer secure
                $sql = "INSERT into tbl_user (FName, LName, Email, Password) VALUES (?, ?, ?, SHA(?))";
                $stmt = mysqli_stmt_init($db);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $password);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                $_SESSION['userId'] = mysqli_stmt_insert_id($stmt);
                $_SESSION['firstName'] = $firstname;
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