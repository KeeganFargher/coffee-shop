<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    include_once("DBConn.php");
    
    $id = $_POST['id'];

    $sql = "SELECT * FROM tbl_item WHERE ID = {$id}";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    echo $row['Sell_Price'];
?>