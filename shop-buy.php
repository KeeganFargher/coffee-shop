<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    session_start();
    include_once("php/DBConn.php");

    function generateShoppingTable($db, $card_style, $button_style, $coffee_strength)
    {
        // Getting specific coffees
        $sql = "SELECT * FROM tbl_item WHERE Coffee_Strength_Id = {$coffee_strength}";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='row'>";

            while ($row = $result->fetch_assoc()) {
                echo
                "<div class='col-12 col-md-4 col-lg-3 card-padding'>" .
                    "<div class='{$card_style}'>" .
                        // Item's picture
                        "<img src='img/shop_coffee/{$row["ID"]}.jpg' class='img-fluid' alt=''>" .

                        // Item's Details
                        "<div class='card-body'>" .
                            "<h5 class='card-title'>{$row["Name"]}</h5>" .

                            "<p class='card-text'>R {$row["Sell_Price"]}</p>" .
                            "<button id='{$row["ID"]}' onClick='onClick($(this))' class='{$button_style}'>Add To Cart</button>" .
                            "</div>" .
                        "</div>" .
                    "</div>";
            }
            
            echo "</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php"); ?>

    <title>Grinder | Shop Coffee</title>
</head>

<body>
    <div class="loader-background">
        <div class="loader"></div>
    </div>

    <?php require("header.php"); ?>

    <!-- Light Roast Coffee -->
    <div class="container-white container-fluid">
        <h1 class="text-center line-under-text">SHOP LIGHT ROAST</h1>

        <div class="cart-items-container">
            <?php 
                generateShoppingTable(
                    $db,
                    "card text-white bg-primary mb-3",
                    "btn btn-outline-secondary button-card-white",
                    1);
            ?>
        </div>
    </div>

    <!-- Dark Roast Coffee -->
    <div class="container-black container-fluid">
        <h1 class="text-center line-under-text">SHOP DARK ROAST</h1>

        <div class="cart-items-container">
            <?php 
                generateShoppingTable(
                    $db,
                    "card border-primary mb-3",
                    "btn btn-primary button-card-black ",
                    2);
            ?>
        </div>
    </div>

    <div class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">The Price of Your Item</h5>

                </div>
                <div class="modal-body">
                    <p id="price"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onClick="closeModal()">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <?php require("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/loader.js"></script>
    <script>
        function onClick(e) {
            let cartItemId = e[0].id;

            $.ajax({
                url: 'php/addToCart.php',
                type: 'POST',
                data: {
                    'id': cartItemId
                },
                success: function (data) {
                    $("#price").text('R' + data);
                    $(".modal").show();
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }

        function closeModal() {
            $(".modal").hide();
        }
    </script>


</body>

</html>