<?php

if (isset($_SESSION['user'])) {
    echo '<script>location.href = "/pizzashop/routes/login.php"</script>';
    exit();
}
include("../partials/header.php");
include("../partials/dbconnect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | About Me</title>
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <div class="width-50p m-4auto">
        <H4>MY PROFILE</H4>
        <div class="mt-2">
            <fieldset class="plane width-75p my-1 rounded-6 px-1 font-color">
                <legend class="main-color">User Name</legend>
                <?php
                $User = $_SESSION['user'];
                $sql = "SELECT * FROM `users` WHERE `user_name` = '$User'";
                $res = mysqli_query($conn, $sql);
                $User = mysqli_fetch_assoc($res);
                // if()
                echo $User['user_name'];
                ?>
            </fieldset>
            <fieldset class="plane width-75p my-1 rounded-6 px-1 font-color">
                <legend class="main-color">Email</legend>
                <?php
                echo $User['user_email'];
                ?>
            </fieldset>
            <fieldset class="plane width-75p my-1 rounded-6 px-1 font-color">
                <legend class="main-color">Contact</legend>
                <?php
                echo '0'.$User['user_contact'];
                ?>
            </fieldset>
        </div>
        <H4 class="mt-3">MY ORDERS</H4>

    </div>
    <?php
    include("footer.php");
    ?>
</body>

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
<script src="../main.js"></script>

</html>