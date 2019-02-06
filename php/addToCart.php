<?php
    
    function addToCart($id) {
        include("php/DBConn.php");

        $sql = "SELECT * FROM tbl_Item WHERE ID = " . $id;
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

?>