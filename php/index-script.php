<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
session_start();
include_once("DBConn.php");

// Define variables and set to empty values
$email = $password = $error = "";
$incorrectDetails = false;

if (isset($_POST['submit'])) {

    // Getting email and password
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //  Select statement to validate if email actually exists
    $sql = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $count = mysqli_num_rows($result);

    // If result == 1 then the email exists
    if ($count === 1) {

        //  Salt and hash the user entered password
        $salt = $row['Salt'];
        $passwordSalt = $password . $salt;
        $passwordHash = sha1($passwordSalt);

        //  If passwords match
        if ($row['Password'] !== $passwordHash) {
            $incorrectDetails = true;
        } 
    } else {
        $incorrectDetails = true;
    }

    if ($incorrectDetails) {
        redirect_to_signup($email, $password);
    } else {
        $_SESSION['userId'] = $row['ID'];
        $_SESSION['firstName'] = $row['FName'];
        $_SESSION['isSignedIn'] = true;
        header("location: ../shop-home.php");
    }
}

function redirect_to_signup($email, $password) {
    $error = "Incorrect Email and/or Password";
    header("location: ../index.php?email=".$email."&password=".$password."&error=".$error);
}
?>