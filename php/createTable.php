<?php
    include("php/DBConn.php");

    remakeTable($db);
    insertData($db);

    $db->close();


function remakeTable($db) {
    $deleteQuery = "DROP TABLE IF EXISTS tbl_User";
    $db->query($deleteQuery);

    $createQuery = "
        CREATE TABLE `tbl_user` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `FName` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `LName` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `Email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `Password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`ID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    $db->query($createQuery);
}

function insertData($db) {

    //  Open File
    $userfile = fopen("data/userData.txt", "r") or die("Unable to open file!");

    $insertQuery = "INSERT INTO tbl_user (FName, LName, Email, Password) VALUES ";

    //  Output one line at a time
    while (!feof($userfile)) {

        //  Split the row into an array
        $split = explode(" ", fgets($userfile));

        //  Trim any spaces
        $split[4] = trim($split[4]);

        //  We are inserting multiple rows at a time rather than one insert statement per row
        //  because it is much faster.
        // https://stackoverflow.com/questions/779986/insert-multiple-rows-via-a-php-array-into-mysql/780046#780046
        $insertQuery = $insertQuery . "('$split[1]', '$split[2]', '$split[3]', '$split[4]'), ";
    }
    fclose($userfile);

    $insertQuery = rtrim($insertQuery, ', ');
    if ($db->query($insertQuery) !== TRUE) {
        echo "Error: " . "<br>" . $db->error ;
    }

}
?>