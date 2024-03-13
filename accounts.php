<?php
include("../partials/header.php");
include("../partials/dbconnect.php");
include("../partials/alert.php");
// LOGIN ACCOUNT
if (isset($_SESSION['user'])) {
    echo '
            <script> 
                location.href = "/pizzashop/";
            </script>
        ';
}
if (isset($_COOKIE['logout']) && isset($_COOKIE['showAlert'])) {
    if ($_COOKIE['logout'] && $_COOKIE['showAlert']) {
        showAlert('sign out successful', 'success');
        setcookie('showAlert', false);
        setcookie('logout', false);
    }
}
if (isset($_POST['login_account'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `user_name`='$name'";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        $User = mysqli_fetch_assoc($res);
        $check = password_verify($pass, $User['user_password']);
        if ($check) {
            setcookie('user', $name);
            setcookie('login', true);
            setcookie('showAlert', true);
            $_SESSION['user'] = $name;
            // header("location: /pizzashop/");
            echo $_SESSION['user'];
            echo $_COOKIE['user'];
            echo $_COOKIE['showAlert'];
            echo $_COOKIE['login'];
            showAlert('logged in ', 'success');
        } else {
            showAlert('invalid credentials', 'error');
        }
    } else {
        showAlert('user not found', 'error');
    }
}
if (isset($_POST['register_account'])) {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirmPass = $_POST['cpassword'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $contact = $_POST['contact'];

    if ($pass != $confirmPass) {
        showAlert('Passwords do not match!', 'error');
    } else {
        $sql = "INSERT INTO `users` ( `user_email`, `user_name`, `user_password`, `user_contact`, `createdAt`) VALUES ('$email', '$name', '$hash', '$contact', current_timestamp())";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            setcookie('signup', true);
            setcookie('user', $name);
            setcookie('showAlert', true);
            echo ' <script>
                location.href = "/pizzashop/";
            </script>
            ';
        } else {
            showAlert('try different credentials', 'error');
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts - Hot Pizza</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../user.css">
</head>

<body>
    <div class="mt-3 px-10">
        <div class="flex gap-3 item-center">
            <form action="accounts.php" method="post" class="width-50p m-auto shadow-light p-2">
                <h2 class="my-1 center">LOGIN HERE</h2>
                <div class="my-1 with-100p">
                    <input type="text" name="username" autocomplete="off" maxlength="15" minlength="3" placeholder="User Name"
                        class="plane p-1  width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="text" name="password" autocomplete="off" maxlength="20" minlength="8" placeholder="Password"
                        class="plane p-1  width-100p">

                </div>
                <div class="my-min center">
                    <a href="/pizzashop/forgotpassword">Forgot Password ? </a>
                </div>
                <div class="mt-2 mb-1 center">
                    <div class="my-min center">
                        <p class="main-color" href="accounts.php">Don't Have an Account Sign Up</p>
                    </div>
                    <input name="login_account" type="submit" value="LOGIN" class="btn">
                    <div class="my-min center">
                        By signing up, you agree to our <span class="main-color">Terms</span> <br> <span
                            class="main-color">Conditions </span> and <span class="main-color">Privacy Policy</span>.
                    </div>
                </div>
            </form>

            <!-- REGISTER ACCOUNT FORM -->
            <form action="accounts.php" method="post" class="width-50p m-auto shadow-light p-2">
                <h2 class="my-1 center">REGISTER HERE</h2>
                <div class="my-1 with-100p">
                    <input type="text" name="username" autocomplete="off" minlength="3" maxlength="15" placeholder="User Name"
                        class="plane p-1  width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="email" name="email" placeholder="Email" minlength="14" maxlength="50" class="plane p-1  width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="tel" name="contact" maxlength="15" minlength="11" placeholder="Contact" class="plane p-1  width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="password" name="password" maxlength="20" minlength="8" placeholder="Password"
                        class="plane p-1  width-100p">
                </div>
                <div class="my-1 with-100p">
                    <input type="password" name="cpassword" maxlength="20" minlength="8" placeholder="Confirm Password"
                        class="plane p-1  width-100p">
                    <small class="pt-1">Both Passwords should be same</small>
                </div>
                <div class="mt-2 mb-1 center">
                    <div class="my-min center">
                        <p class="main-color" href="accounts.php">Already Have an Account Login</p>
                    </div>

                    <input type="submit" name="register_account" value="REGISTER" class="btn">
                </div>
            </form>
        </div>
    </div>

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
<!-- <script src="main.js"></script> -->

</html>