<?php
session_start();
include_once("DBConn.php");

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
    if ($count == 1) {
        $_SESSION['userId'] = $row['ID'];
        $_SESSION['firstName'] = $row['FName'];
        $_SESSION['isSignedIn'] = true;

        $error = "";

        header("location: ../shop-home.php");
    } else {
        $error = "Incorrect Email and/or Password";
        header("location: ../index.php?email=".$email."&password=".$password."&error=".$error);
    }
}
?>