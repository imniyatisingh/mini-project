<?php
include("../partials/header.php");
include("../partials/dbconnect.php");
include("../partials/alert.php");

if (isset($_POST['removefromcart'])) {
    $id = $_POST['product_id'];
    $sql = "DELETE FROM `cart_items` WHERE `cart_items`.`product_id` = $id";
    $isSubmitted = mysqli_query($conn, $sql);

    if ($isSubmitted)
        showAlert('item removed from cart', 'success');
    else
        showAlert('500! Internal server error', 'error');

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pizzata | My Cart</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../Utility.css" />
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../user.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <script>

        let Alert = document.querySelector(".alert");
        const hideAlert = () => {

            Alert.style.display = 'none';

        }
        let dropDown = document.querySelector("#dropdown");
        let drop = document.querySelector(".drop");

        dropDown.addEventListener("click", () => {
            drop.classList.toggle('active');
        });

    </script>
</head>

<body>

    <div class="container">
        <?php if (!isset($_SESSION['user'])) {
            echo ' <div class="mt-7 center">
            <p class="my-min">Sorry you can not view your cart items if you are not login</p>
            <p class="my-min">login Here to access your cart.</p>
            <div class="mt-2">
                <a class="btn mt-2 " href="/pizzashop/routes/login.php" role="button">LOGIN</a>
            </div>
        </div>';
            exit();
        }
        ?>
        <div class="row-3">
            <?php

            $name = $_SESSION['user'];
            $sql = "SELECT * FROM `cart_items` WHERE `product_user` = '$name'";
            $res = mysqli_query($conn, $sql);
            // echo $res;
            $totalProducts = 0;
            $totalPrice = 0;
            $prodExist = false;
            $all_products = '';
            while ($row = mysqli_fetch_assoc($res)) {
                $prodExist = true;
                $all_products = $all_products . $row['product_name'] . ' ,';
                $totalProducts += $row['product_quantity'];
                $totalPrice += $row['product_price'];
                echo '<div class="col text-left shadow-light rounded-6 ">
                <div class="flex item-center space-between">
                    <div class="flex item-center gap-1">
                        <img src="../imgs/' . $row['product_name'] . '.jpg" alt="Pizza 1" width="60">
                        <div>
                            <p>' . $row['product_name'] . ' x ' . $row['product_quantity'] . ' </p>
                            <p><span class="main-color">Price </span> ' . $row['product_price'] . '.00</p>
                        </div>
                    </div>
                    <form action="cart.php" method="post">
                        <input name="product_id" hidden value="' . $row['product_id'] . '" />
                        <button type="submit" name="removefromcart" class="btn">Remove</button>
                        </form>
                </div>
                </div>';
            }
            substr($all_products, 0, strlen($all_products) - 2);
            $_SESSION['PRODUCT'] = $all_products;
            $_SESSION['QTY'] = $totalProducts;
            $_SESSION['PRICE'] = $totalPrice;
            ?>
        </div>
        <?php

        if ($prodExist) {
            echo '
        <hr>
        <div class="flex  content-end p-2">
            <div class="width-25p">
                <p class="flex  item-center space-between my-min"><span>Items</span>
                    <span class="main-color">
                        ' . $totalProducts . '
                    </span>
                </p>
                <p class="flex  item-center space-between my-min"><span>Price</span>
                    <span class="main-color">
                        ' . "Rs. " . $totalPrice . ".00" . '
                    </span>
                </p>
                <p class="flex  item-center space-between my-min"><span>Shipping Fee</span>
                    <span class="main-color">
                       ';
            if ($totalPrice > 10000) {
                echo "Rs. " . "800.00";
            } else {
                echo "Rs. " . $totalPrice * .05 . ".00";
            }
            echo '
                    </span>
                </p>
                <hr class="my-2">
                <p class="flex  item-center space-between my-min"><span>TOTAL PRICE</span>
                    <span class="main-color">
                        ';
            if ($totalPrice > 10000) {
                echo "Rs. " . $totalPrice + 800 . ".00";
            } else {
                echo "Rs. " . $totalPrice + ($totalPrice * .05) . ".00";
            }
            echo '
                    </span>
                </p>
                <a href="/pizzashop/routes/order.php"  class="btn mt-2 block" >ORDER NOW</a>
            </div>
        </div>';
        } else {
            echo ' <div class="flex gap-2 content-center direction-col item-center mt-5">
                <h2>Sorry your Cart is Empty Add Products to the cart</h2>
                <h2>and Then Order them</h2>
                <a href="/pizzashop/index.php" class="btn">MENU</a>
            </div>';
        }

        ?>
        <?php
        include("footer.php");
        ?>
    </div>

</body>

<script src="../main.js"></script>

</html>