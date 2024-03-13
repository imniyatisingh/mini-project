<?php
include("../partials/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzata | Contact Us</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../user.css">
</head>

<body>
    <div class="container">
        <form action="accounts.php" method="post" class="width-50p m-auto shadow-light p-2">
            <h2 class="my-1 center">FEEL FREE TO CONTACT</h2>
            <div class="my-1 with-100p">
                <input type="text" name="username" autocomplete="off"
                    maxlength="15" placeholder="User Name" class="plane p-1  width-100p">
            </div>
            <div class="my-1 with-100p">
                <input type="text" name="email" autocomplete="off" maxlength="15" placeholder="Email"
                    class="plane p-1  width-100p">
            </div>
            <div class="my-1 with-100p">
                <input type="text" name="contact" autocomplete="off" maxlength="4" placeholder="Contact"
                    class="plane p-1  width-100p">
            </div>
            <div class="my-1 with-100p">
                <textarea rows="3" type="text" name="username" autocomplete="off" maxlength="15" placeholder="Your Concern/Query"
                    class="plane p-1  width-100p"></textarea>
            </div>
            <div class="mt-2 mb-1 ">
                <input name="login_account" type="submit" value="SEND" class="btn">
            </div>
        </form>
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