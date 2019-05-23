<?php

class ShoppingCart {

    private $database;
    private $items = array();
    private $shoppingCart = array();

    /* Used to display toasts in the html */
    private $shoppingCartStatus = "";
    private $toastMessage = "";

    private $DBName = "onlinestore";
    private $TableName = ""; 
    private $Count = 0; 
    private $DBConnect="";
    private $Orders = array();
    private $OrderTable = array();


    public function __construct() {
        include_once("DBConn.php");
        $this->database = $db;
        $this->shoppingCartStatus = "";
    }

    function __destruct()
    {
        $this->database->close();
    }

    function __wakeup()
    {
        include_once("DBConn.php");
        $this->database = $db;

        if ($this->shoppingCartStatus === "Added Item To Cart") {
            $this->toastMessage = $this->shoppingCartStatus;
            $this->shoppingCartStatus = "";
        } else {
            $this->toastMessage = "";
        }
    }

    public function getDatabase() {
        return $this->database;
    }

    public function loadItems() {
        if (count($this->items) === 0) { return; }

        $sql = "SELECT * FROM tbl_item";
        $result = @$this->database->query($sql);

        $this->items = array();
        while ($row = $result->fetch_assoc()) {
            $this->items[$row['ID']] = array();
            $this->items[$row['ID']]['Name'] = $row['Name'];
            $this->items[$row['ID']]['Description'] = $row['Description'];
            $this->items[$row['ID']]['Cost_Price'] = $row['Cost_Price'];
            $this->items[$row['ID']]['Quantity'] = $row['Quantity'];
            $this->items[$row['ID']]['Sell_Price'] = $row['Sell_Price'];
            $this->items[$row['ID']]['Coffee_Strength_Id'] = $row['Coffee_Strength_Id'];
        }
        $_SESSION['cartCount'] = $this->getCartCount();
    }

    public function initializeCart() {
        foreach ($this->items as $Id => $item) {
            $this->shoppingCart[$Id] = 0;
        }
    }

    public function getProducts($card_style, $button_style, $title_style, $description_style, $coffee_strength_id) {
        // Pull items from database
        $sql = "SELECT * FROM tbl_item WHERE Coffee_Strength_Id = {$coffee_strength_id}";
        $result = $this->database->query($sql);

        // Don't bother running the rest of the code if it's empty
        if ($result->num_rows <= 0) { return; } 
        
        echo "<div class='row'>"; 
        
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-12 col-sm-6 col-md-4 col-lg-3 card-padding'>";
                echo "<div class='card mb-3 {$card_style}'>";
                // Item's picture
                echo "<img src='img/shop_coffee/{$row['ID']}.jpg' class='img-fluid loading' alt='Thumbnail of coffee beans'>";
                // Item's Details
                echo "<div class='card-body'>";
                    echo "<h5 class='card-title text-center {$title_style}'>{$row['Name']}</h5>";
                    echo "<p class='card-price'>R {$row['Sell_Price']}</p>";
                    echo "<p class='card-description {$description_style}'>{$row['Description']}</p>";
                    echo "<a href='{$_SERVER['SCRIPT_NAME']}?ItemToAdd={$row['ID']}' id='{$row['ID']}' class='btn {$button_style}'>Add To Cart</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }

        // Closing row
        echo "</div>";
    }

    public function getCart() {
        foreach ($this->items as $ID => $item) {

            if ($this->shoppingCart[$ID] === 0) continue;

            echo "<tr>";

            echo "<td><img src='img/shop_coffee/{$ID}.jpg' class='img-thumbnail' alt='Thumbnail of coffee beans'></td>";
            echo "<td>". $item["Name"] ."</td>";
            echo "<td> R". $item["Sell_Price"] ."</td>";
            echo "<td>". $this->shoppingCart[$ID] ."</td>";

            echo "</tr>";
            
        }
    }

    public function getCartCount() {
        if (empty($this->shoppingCart)) return 0;

        $total = 0;
        foreach ($this->shoppingCart as $item) {
            $total += $item;
        }
        return $total;
    }

    public function getToastMessage() {
        return $this->toastMessage;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }

    public function processUserInput() {
        if (!empty($_GET['GetShoppingCartList'])) {
            $this->getShoppingList();
        }
        else if (!empty($_GET['ItemToAdd'])) {
            $this->addItem();
        }
        else if (!empty($_GET['AddOne'])) {
            $this->addOne();
        }
        else if(!empty($_GET['ItemToRemove'])) {
            $this->removeItem();
        }
        else if (!empty($_GET['EmptyCart'])) {
            $this->emptyCart();
        }
        else if (!empty($_GET['RemoveAll'])) {
            $this->removeAll();
        }
    }

    /* Updates the quantity of a specific item when you are in 'Shop now' */
	private function addItem() {
        $itemId = $_GET['ItemToAdd'];
        $this->shoppingCart[$itemId] += 1;

        //  Create a session so we can just access the cart count anywhere
        $_SESSION['cartCount'] = $this->getCartCount();
        $this->shoppingCartStatus = "Added Item To Cart";
        header("location: shop-buy.php");
    }
}