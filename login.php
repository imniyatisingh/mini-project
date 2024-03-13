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
if (isset($_POST['login'])) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `user_name`='$name'";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            $User = mysqli_fetch_assoc($res);
            if ($User) {
                $check = password_verify($pass, $User['user_password']);
                if ($check) {
                    $_SESSION['user'] = $name;
                    $_SESSION['login'] = true;
                    $_SESSION['showAlert'] = true;
                    echo '<script>location.href = "/pizzashop/"</script>';
                } else {
                    showAlert('invalid credentials', 'error');
                }
            } else {
                showAlert('invalid credentials', 'error');
            }
        } else {
            showAlert('user not found', 'error');
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
    <title>Pizzata | Login Account</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../user.css">
</head>

<body>
    <div class="form">
        <form action="login.php" method="post" >
            <h2 class="my-2 center">LOGIN HERE</h2>
            <div class="my-1 with-100p">
                <input type="text" name="username" autocomplete="off" maxlength="15" minlength="3"
                    placeholder="User Name" class=" p-1  width-100p">
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="password" autocomplete="off" maxlength="20" minlength="1"
                    placeholder="Password" class=" p-1 passwd  width-100p">
                <button type="button" role="button" onclick="handleShow()"
                    class="showHide d-none ">SHOW</button>
            </div>
            <div class="my-min center">
                <a href="/pizzashop/routes/forgotpassword.php" class="main-color">Forgot Password ? </a>
            </div>
            <div class="mt-2 mb-1 center">
                <div class="my-min center">
                    <a class="main-color" href="/pizzashop/routes/signup.php">Don't Have an Account Sign Up</a>
                </div>
                <input type="submit" name="login" value="LOGIN" class="btn">
                <div class="my-min center">
                    By signing up, you agree to our <span class="main-color">Terms</span> <br> <span
                        class="main-color">Conditions </span> and <span class="main-color">Privacy Policy</span>.
                </div>
            </div>
        </form>
    </div>

</body>


<script>
    let Alert = document.querySelector(".alert");
    const hideAlert = () => {
        Alert.style.display = 'none';
    }
    let dropDown = document.querySelector("#dropdown");
    let drop = document.querySelector(".drop");
    let showHideBtns = Array.from(document.querySelectorAll(".showHide"));
    let passwds = Array.from(document.querySelectorAll(".passwd"));
    console.log(passwds)
    passwds.forEach(passwd => {
        passwd.addEventListener('input', (e) => {
            if (e.target.value.length > 0) {
                passwd.nextElementSibling.style.display = 'block';
            } else {
                passwd.nextElementSibling.style.display = 'none';
            }
        })
    })
    showHideBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let sib = btn.previousElementSibling;
            if (sib.type == "text") {
                sib.type = "password";
                btn.innerText = "SHOW";
            } else {
                sib.type = "text";
                btn.innerText = "HIDE";
            }
        })

    });
    dropDown.addEventListener("click", () => {
        drop.classList.toggle('active');
    });

</script>

</html>