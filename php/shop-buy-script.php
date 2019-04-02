<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php

function generateShoppingTable($db, $card_style, $button_style, $coffee_strength)
{
    // Pull items from database
    $sql = "SELECT * FROM tbl_item WHERE Coffee_Strength_Id = {$coffee_strength}";
    $result = $db->query($sql);

    // Don't bother running the rest of the code if it's empty
    if ($result->num_rows < 0) { return; } // Opening row 

    echo "<div class='row'>"; 

    while ($row=$result->fetch_assoc()) {
        echo
        "<div class='col-12 col-md-4 col-lg-3 card-padding'>" .
            "<div class='{$card_style}'>" .
                // Item's picture
                "<img src='img/shop_coffee/{$row['ID']}.jpg' class='img-fluid loading' alt='Thumbnail of coffee beans'>" .

                // Item's Details
                "<div class='card-body'>" .
                    "<h5 class='card-title'>{$row['Name']}</h5>" .

                    "<p class='card-text'>R {$row['Sell_Price']}</p>" .
                    "<button id='{$row['ID']}' onClick='addToCartOnClick($(this))' class='{$button_style}'>Add To Cart</button>" .
                    "</div>" .
                "</div>" .
            "</div>";
        }

        // Closing row
        echo "</div>";
}
?>