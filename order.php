<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | Order Process</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <?php

    include("../partials/header.php");
    include("../partials/dbconnect.php");
    include("../partials/alert.php");
    // ORDER MANAGEMENT STARTS
    $total_products = $_SESSION['PRODUCT'];
    $totalProducts = $_SESSION['QTY'];
    $totalPrice = $_SESSION['PRICE'];
    $sql = "SELECT * FROM `cart_items`";
    $res = mysqli_query($conn, $sql);
    $prodExist = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $total_products = substr($total_products, 0, strlen($total_products) - 2);
        $pay_method = $_POST['pay_method'];
        $pincode = $_POST['pincode'];
        $contact = $_POST['contact'];
        $add01 = $_POST['add01'];
        $add02 = $_POST['add02'];
        $username = $_SESSION['user'];

        $sql = "INSERT INTO `pizza_orders` (`total_products`, `order_quantity`, `order_user`, `order_user_contact`, `address line01`, `address line02`, `pincode`, `placedAt`, `payment`, `payment_method`) VALUES ('$total_products', '$totalProducts', '$username', '$contact', '$add01', '$add02', '$pincode', current_timestamp(), '$totalPrice', '$pay_method')";
        $res = mysqli_query($conn, $sql);

        // ORDER MANAGEMENT ENDS
        if ($res) {

            $sql = "DELETE FROM `cart_items` WHERE `ordered` = 'true'";
            $res = mysqli_query($conn, $sql);

            // $row = mysqli_num_rows($res);
            if ($res) {
                showAlert('Order placed  successfully', 'success');
                echo '<script>location.href = "/pizzashop"</script>';
            } else
                showAlert('500! Internal server error', 'error');
        }
    }


    ?>
    <div class="form">

        <?php
        echo '<form action="order.php" method="post" class="order_form width-75 m-auto p-2">
    <h2 class="my-1 center">ORDER NOW</h2>
    <div class="flex gap-1">
        <div class="width-50p">
        <div class="my-1 with-100p">
        <label class="my-min block" for="contact">Contact</label>
        <input type="tel" name="contact"  autocomplete="off" maxlength="12" minlength="11" placeholder="03******34"
            class="rounded-full p-1  width-100p">
    </div>
            <div class="my-1 with-100p">
                <label class="my-min block" for="add01">Address line 01</label>
                <input type="text" name="add01" maxlength="200" minlength="15"   placeholder="eg.flat no" class="rounded-full p-1  width-100p">
            </div>
            <div class="my-1 with-100p">
                <label class="my-min block" for="add02" >Address line 02</label>
                <input type="text" name="add02" autocomplete="off" 
                maxlength="200" minlength="15" 
                    placeholder="eg.near safest school" class="rounded-full p-1  width-100p">
            </div>
            
        </div>

        <div class="width-50p gap-1 mt-min">
            <div class="my-1 with-100p">
                        <label name="pincode">Area Pin Code</label>
                        <input type="tel" name="pincode" autocomplete="off"  maxlength="10" minlength="5"   placeholder="eg.123456"
                            class="rounded-full p-1 width-100p">
                    </div>
                    <div class="my-1 with-100p">
                        <label class="my-min block" for="pay_method">Payment Method</label>
                        <select name="pay_method" autocomplete="off" placeholder="User Name"
                            class="rounded-full round p-1 mt-min width-100p">
                            <option selected value="cash on delivery" class="rounded-full  width-100p">Cash On Delivery
                            </option>
                            <option value="online" class="rounded-full p-1  width-100p">Online</option>
                    </div>
                </div>
            </div>
            <input type="submit" value="ORDER NOW" class="btn width-50p block p-1 m-2auto" />
        </form>'
            ?>

    </div>
</body>
<script>
    // let Alert = document.querySelector(".alert");
    // const hideAlert = () => {
    //     Alert.style.display = 'none';

    // }
    let dropDown = document.querySelector("#dropdown");
    let drop = document.querySelector(".drop");

    dropDown.addEventListener("click", () => {
        drop.classList.toggle('active');
    });

</script>
<script src="../main.js"></script>

</html>