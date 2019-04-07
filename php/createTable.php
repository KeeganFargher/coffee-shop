<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    include_once("DBConn.php");

    $coffeeStrengthSql = 
    "CREATE TABLE IF NOT EXISTS `tbl_coffee_strength` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `Strength` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`Id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $itemSql =
    "CREATE TABLE IF NOT EXISTS `tbl_item` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `Description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `Cost_Price` decimal(15,2) NOT NULL,
    `Quantity` int(11) NOT NULL,
    `Sell_Price` decimal(15,2) NOT NULL,
    `Coffee_Strength_Id` int(11) NOT NULL,
    PRIMARY KEY (`ID`),
    KEY `coffee_strength_id_constraint` (`Coffee_Strength_Id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

    $userSql = 
    "CREATE TABLE `tbl_user` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `FName` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `LName` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `Email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `Password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `Salt` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    echo "<h1>REMAKING TABLES & INSERTING DATA</h1>";
    echo "<hr />";

    dropTable($db, "tbl_coffee_strength");
    dropTable($db, "tbl_item");
    dropTable($db, "tbl_user");

    echo "<hr />";

    createTable($db, "tbl_coffee_strength", $coffeeStrengthSql);
    createTable($db, "tbl_item"           , $itemSql);
    createTable($db, "tbl_user"           , $userSql);

    echo "<hr />";

    insertData($db, "coffeeStrength.txt" , "tbl_coffee_strength", "Strength");
    insertData($db, "item.txt"           , "tbl_item"           , "Name, Cost_Price, Quantity, Sell_Price, Coffee_Strength_Id, Description");
    insertData($db, "userData.txt"       , "tbl_user"           , "FName, LName, Email, Password, Salt");

    echo "<hr />";

/* Drops the table if it exists */
function dropTable($db, $tableName) {
    $dropQuery = "DROP TABLE IF EXISTS $tableName;";
    echo ( $db->query( $dropQuery ) === TRUE ) ? "Dropped <b>$tableName</b>..." : "Error dropping $tableName: " . $db->error;
    echo "<br />";
}

/* Creates the table */
function createTable($db, $tableName, $sql) {
    echo ($db->query($sql) === TRUE) ? "Created <b>$tableName</b>..." : "Error creating $tableName: " . $db->error;
    echo "<br /> ";
}

/* Generic insert method that inserts data from a text file into a table */
function insertData($db, $fileName, $tableName, $tableColumns) {

    //  Define variables
    $insertStatement = "INSERT INTO $tableName ($tableColumns) VALUES ";
    $sql = "";

    //  Open the file
    $file = fopen("../data/$fileName", "r") or die("Unable to open file $fileName for $tableName");

    // Output one line at a time
    while (!feof($file)) {

        // Split the row into an array
        $split = explode("*", fgets($file));

        $row = getRow($split);

        $sql .= $insertStatement . $row;
    }
    fclose($file);

    echo ($db->multi_query($sql) === TRUE) ? "Inserted data into <b>$tableName</b> successfully..." : "Error inserting data into $tableName: " . $db->error;
    echo "<br />";

    //  https://stackoverflow.com/questions/27899598/mysqli-multi-query-commands-out-of-sync-you-cant-run-this-command-now    
    while ($db->next_result()) {;}
}

/*  Fetches a row and returns it in the format (?, '?', ?); */
function getRow($split) {
    $queryValues = "";

    for ($i = 0; $i < count($split); $i++) {

        $queryValues .= "'" . trim($split[$i]) . "'";

        //  We don't want to add a comma to the last value
        if ($i < count($split) - 1) { $queryValues .= ", "; }
    }

    $queryValues = "(" . $queryValues . ");";

    return $queryValues;
}
?>