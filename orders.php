<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | Orders</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="../Admin/css/admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <?php

    include("../partials/header.php");
    include("../partials/dbconnect.php");
    include("../partials/alert.php");
    // ORDER MANAGEMENT STARTS
    
    // ORDER MANAGEMENT ENDS
    
    if (isset($_POST['deleteorder']) || isset($_POST['cancelorder'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // _POST is a global variable
            $id = $_POST['order_id'];
            $sql = "DELETE FROM `pizza_orders` WHERE `pizza_orders`.`order_id` = $id";
            $isSubmitted = mysqli_query($conn, $sql);
            $msg = '';
            if (isset($_POST['cancelorder'])) {
                $msg = 'Order canceled successfully';
            } else {
                $msg = 'Order deleted successfully';
            }
            if ($isSubmitted) {
                showAlert($msg, 'success');
                unset($_SESSION['PRODUCT']);
                unset($_SESSION['QTY']);
                unset($_SESSION['PRICE']);
            } else {
                showAlert('500! Internal server error', 'error');
            }
        }
    }
    ?>
    <div class="container">
        <?php
        if (!isset($_SESSION['user'])) {

            echo '
            <div class="center mt-7">
            <h2 class="center my-1">login here to see your orders 
            </h2><a href="/pizzashop/routes/login.php" class="btn">login</a>
            </div>
            ';
            exit(0);
        } ?>
        <div class="row-3">

            <?php
            if (!isset($_SESSION['user'])) {
                echo '<h2 class="center mt-5">you are not logged in</h2>';
                exit();
            }
            $loggedIn = $_SESSION['user'];
            $sql = "SELECT * FROM `pizza_orders` WHERE `order_user` = '$loggedIn'";
            $res = mysqli_query($conn, $sql);
            $prodExist = false;

            while ($order = mysqli_fetch_assoc($res)) {
                $prodExist = true;

                echo ' <div class="order_box">
                        <p class="my-1 text__color"><b class="my-1 text__color p-font ">User name</b> <span class="ml-min">
                                ' . $order['order_user'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1  p-font text__color">Total products </b> <span class="ml-min">
                                ' . $order['total_products'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1  p-font text__color">Contact </b> <span class="ml-min">
                                ' . $order['order_user_contact'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1  p-font text__color">Address</b> <span class="ml-min">
                                ' . $order['address line01'] . ' , ' . $order['address line02'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1 text__color p-font ">Total price</b> <span class="ml-min">
                                ' . $order['payment'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1 text__color p-font ">Payment method </b> <span class="ml-min">
                                ' . $order['payment_method'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1 text__color p-font ">Order status</b> <span class="ml-min">
                                ' . $order['order_status'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1 text__color p-font ">Payment status</b> <span class="ml-min">
                                ' . $order['payment_status'] . '
                            </span></p>
                        <p class="my-1 text__color"><b class="my-1 text__color p-font ">Ordered At</b> <span class="ml-min">
                            ' . $order['placedAt'] . '
                            </span></p>
                    <div>
            <form action="orders.php" method="post">
                <div class="my-1 with-100p">
                    <input type="text" name="order_id" hidden value="' . $order['order_id'] . '" autocomplete="off" maxlength="15" >
                </div>
                <div class="mt-2 mb-1 center">';
                if ($order['order_status'] == 'pending') {
                    echo '<input type="submit" name="cancelorder" value="CANCEL" class="btn btn-dark curve btn-1">';
                }
                echo '
                </div>
            </form>        
        </div>
    </div>';
            }

            ?>

        </div>
        <?php
        if (!$prodExist) {
            echo ' <div class="flex gap-2 content-center direction-col item-center mt-5">
            <h2>You Don\'t have Any Orders Placed</h2>
            <a href="/pizzashop/index.php" class="btn">Order Now</a>
        </div>';

        }
        ?>
    </div>
    <?php
    include("footer.php");
    ?>
</body>
<script>

    let dropDown = document.querySelector("#dropdown");
    let drop = document.querySelector(".drop");

    dropDown.addEventListener("click", () => {
        console.log('hello')
        drop.classList.toggle('active');
    });
    let Alert = document.querySelector(".alert");
    const hideAlert = () => {
        Alert.style.display = 'none';
    }
</script>
<script src="../main.js"></script>

</html>