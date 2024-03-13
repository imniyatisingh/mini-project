<?php
include("partials/dbconnect.php");
include("partials/header.php");
include("partials/alert.php");
if (isset($_SESSION['showAlert']) && isset($_SESSION['login'])) {
    showAlert('you are logged in', 'success');
    unset($_SESSION['showAlert']);
    unset($_SESSION['login']);
}

if (isset($_SESSION['showAlert']) && isset($_SESSION['signup'])) {
    if ($_COOKIE['signup'] && $_COOKIE['showAlert']) {
        showAlert('Account created successfully<br>and you are logged in', 'success');
        unset($_SESSION['showAlert']);
        unset($_SESSION['signup']);
    }
}

// adding items to cart

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user'])) {
        // showAlert('login to add items to cart', 'success');
        echo '<script>location.href = "/pizzashop/login.php"</script>';
    } else {
        // _POST is a global variable
        $pizzaName = $_POST['pizza_name'];
        $pizzaPrice = $_POST['pizza_price'];
        $qty = $_POST['quantity'];
        $username = $_SESSION['user'];
        $total = $pizzaPrice * $qty;
        if ($qty == 0) {
            showAlert('quantity must be one or greater', 'error');
        } else {
            $sql = "SELECT * FROM `cart_items` WHERE `product_name` = '$pizzaName' AND product_user = '$username'";
            $isSubmitted = mysqli_query($conn, $sql);
            // $row = mysqli_fetch_assoc($isSubmitted)
            if ($row = mysqli_fetch_assoc($isSubmitted)) {
                $newQty = $qty + $row['product_quantity'];
                $sql = "UPDATE `cart_items` SET `product_quantity` = '$newQty' WHERE product_name = '$pizzaName' AND product_user = '$username'";
                $isSubmitted = mysqli_query($conn, $sql);
                if ($isSubmitted) {
                    showAlert('item updated in cart', 'success');
                    echo '<script>
                    setTimeout(() => {
                        location.href = "/pizzashop/routes/cart.php"
                    }, 2000);</script>';
                } else {
                    showAlert('item could not updated to cart', 'error');
                }

            } else {
                $sql = "INSERT INTO `cart_items` ( `product_name`, `product_price`, `product_quantity`, `product_user`, `ordered`, `addedAt`) VALUES ( '$pizzaName', '$total', '$qty', '$username', 'true', current_timestamp())";

                $res = mysqli_query($conn, $sql);

                if ($res) {
                    showAlert('item added to cart', 'success');
                    echo '<script>setTimeout(() => {
                        location.href = "/pizzashop/routes/cart.php"
                    }, 2000);</script>';
                } else {
                    showAlert('item not added to cart', 'error');
                }
            }
        }

    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pizzata | Home</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="Utility.css" />
    <link rel="stylesheet" href="user.css" />
    <link rel="stylesheet" href="alert.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>

    <div class="carcontMaine">
        <div class="carcont">
            <div class="carimg">
                <img src="imgs/home-img-1.png" alt="" />
            </div>
            <div class="carimg">
                <img src="imgs/home-img-2.png" alt="" />
            </div>
            <div class="carimg">
                <img src="imgs/home-img-3.png" alt="" />
            </div>
        </div>
        <div class="PizzaNames">
            <h1 class="PizzaName">Homemade</h1>
            <h1 class="PizzaName">Pepperoni Pizza</h1>
            <!-- <i  class="uil exsmall-font bg-color uil-angle-right-b"></i> -->
            <i id="prev" class="uil exsmall-font uil-angle-left-b"></i>
            <i id="next" class="uil exsmall-font bg-color uil-angle-right-b"></i>
        </div>
    </div>
    <section id="aboutus">
        <h1 class="small-font my-3 center">About Us</h1>
        <div class="row">
            <div class="col">
                <img class="product-img" src="imgs/about-1.svg" alt="" />
                <h2 class="mt-1">Made with love</h2>
                <p class="line-height">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Magni beatae soluta unde dignissimo. Illo, excepturi.
                </p>
                <button class="btn mt-1 btn-max">Our Menu</button>
            </div>
            <div class="col">
                <img class="product-img" src="imgs/about-2.svg" alt="" />
                <h2 class="mt-1">30 minutes Delivery</h2>
                <p class="line-height">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Magni beatae soluta unde dignissimo. Illo, excepturi.
                </p>
                <button class="btn mt-1 btn-max">Our Menu</button>
            </div>
            <div class="col">
                <img class="product-img" src="imgs/about-3.svg" alt="" />
                <h2 class="mt-1">Share with freinds</h2>
                <p class="line-height">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Magni beatae soluta unde dignissimo. Illo, excepturi.
                </p>
                <button class="btn mt-1 btn-max">Our Menu</button>
            </div>
        </div>
    </section>
    <section id="menu">
        <h1 class="small-font mb-3 center">Our Menu</h1>
        <div class="row">
            <?php
            $sql = "SELECT  * from pizzas";
            $result = mysqli_query($conn, $sql);
            $i = 1;
            // echo $_SESSION['user'];
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col text-left">
                    <img class="product-img" src="imgs/' . $row['pizza_name'] . '.jpg" />
                    <div class="">
                     <p class="weight-500 my-min">' . $row['pizza_name'] . '</p>
                        <span class="main-color">Rs ' . $row['pizza_price'] . ' <small class="line-through color-gray">' . $row['pizza_price'] * 1.2 . '</small></span>
                    </div>
                    <div class="mt-min">
                        <form onsubmit="funcx"  action =' . $_SERVER["REQUEST_URI"] . ' method="post" >
                            <input value="' . $row['pizza_name'] . '"  hidden name="pizza_name" class="plane" type="text" />
                            <input value="' . $row['pizza_price'] . '" hidden name="pizza_price" class="plane"     type="number" />
                            <div class="center">             
                            <input value="1" minlength="1" name="quantity" max="100" maxlength="99" min="0" class="quantity main-color plane" type="number" />
                                <input type="submit" value="Add to Cart" class="btn width-75p mx-min"/>
                            </div>
                        </form>
                    </div>
                    </div>';
            }
            ?>
        </div>


    </section>

    <footer>
        <div class="row">
            <div class="col">
                <i class="uil  exsmall-font uil-phone"></i>
                <h3>Phone Number</h3>
                <p class="my-min">0342-32435232</p>
                <p class="my-min">0342-32435232</p>
            </div>
            <div class="col">
                <i class="uil exsmall-font uil-map-marker-alt"></i>
                <h3>Our Address</h3>
                <p class="my-min">
                    turkey , istanbul butcher road street 34 , shop 25
                </p>
            </div>
            <div class="col">
                <i class="uil exsmall-font uil-clock"></i>
                <h3>Opening Hours</h3>
                <p class="my-min">9am - 11pm</p>
            </div>
            <div class="col">
                <i class="uil exsmall-font uil-envelope"></i>
                <h3>Email</h3>
                <p class="my-min">mrsaad2129@gmail.com</p>
            </div>
        </div>
    </footer>
    <?php
    include("./routes/footer.php");
    ?>
</body>
<script>

    let dropDown = document.querySelector("#dropdown");
    let drop = document.querySelector(".drop");

    dropDown.addEventListener("click", () => {
        drop.classList.toggle('active');
    });
    const funcx = (e) => {
        console.log('here');
    }

</script>
<!-- <script src="routes/main.js"></script> -->

</html>