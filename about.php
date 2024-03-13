<?php
include("../partials/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | About</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <div class="mt-3 center">
        <h1 class="">WELCOME TO PIZZA ISTAN </h1>
        <p class="my-min">Here are delicious pizzas you can check them and by simply creating account you can order
            the pizza any of them you like</p>
        <p class="my-min">If you have an Account Simply login Here.</p>
        <div class="mt-2">

            <a class="btn mt-2 " href="/pizzashop/routes/accounts.php" role="button">LOGIN</a>
        </div>
    </div>
    <?php
    include("footer.php");
    ?>
</body>

<script >
    
let Alert = document.querySelector(".alert");
const hideAlert = ()=>{

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