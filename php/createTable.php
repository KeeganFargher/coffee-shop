<?php
    include("php/DBConn.php");

    remakeCoffeeStrengthTable($db);
    insertCoffeeStrengthData($db);

    remakeItemTable($db);
    insertItemData($db);

    remakeUserTable($db);
    insertUserData($db);

function remakeCoffeeStrengthTable($db) {
    $drop = "DROP TABLE IF EXISTS tbl_coffee_strength;";
    $db->query($drop);

    $createQuery = "
        CREATE TABLE IF NOT EXISTS `tbl_coffee_strength` (
        `Id` int(11) NOT NULL AUTO_INCREMENT,
        `Strength` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`Id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $db->query($createQuery);
}

function insertCoffeeStrengthData($db) {
    $sql = "INSERT INTO tbl_coffee_strength (Strength) VALUES ('Light Roast'), ('Dark Roast');";
    if ($db->query($sql) !== TRUE) {
        echo "Error: " . "<br>" . $db->error ;
    }
}

function remakeItemTable($db) {
    $drop = "DROP TABLE IF EXISTS tbl_item;";
    $db->query($drop);

    $createQuery = "
        CREATE TABLE IF NOT EXISTS `tbl_item` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `Cost_Price` decimal(15,2) NOT NULL,
        `Quantity` int(11) NOT NULL,
        `Sell_Price` decimal(15,2) NOT NULL,
        `Coffee_Strength_Id` int(11) NOT NULL,
        PRIMARY KEY (`ID`),
        KEY `coffee_strength_id_constraint` (`Coffee_Strength_Id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $db->query($createQuery);
}

function insertItemData($db) {
    // Open File
    $file = fopen("data/item.txt", "r") or die("Unable to open file!");

    $insertQuery = "INSERT INTO tbl_item (Name, Cost_Price, Quantity, Sell_Price, Coffee_Strength_Id) VALUES ";

    // Output one line at a time
    while (!feof($file)) {

        // Split the row into an array
        $split = explode(",", fgets($file));

        // We are inserting multiple rows at a time rather than one insert statement per row
        // because it is much faster.
        // https://stackoverflow.com/questions/779986/insert-multiple-rows-via-a-php-array-into-mysql/780046#780046
        $insertQuery = $insertQuery . "('$split[0]', $split[1], $split[2], $split[3], $split[4]), ";
    }
    fclose($file);

    $insertQuery = rtrim($insertQuery, ', ');
    if ($db->query($insertQuery) !== TRUE) {
        echo "Error: " . "<br>" . $db->error ;
    }
}

function remakeUserTable($db) {
    $drop = "DROP TABLE IF EXISTS tbl_user;";
    $db->query($drop);

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

function insertUserData($db) {
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