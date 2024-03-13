<?php
include("../partials/header.php");
include("../partials/dbconnect.php");
include("../partials/alert.php");
// REGISTER ACCOUNT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $_SESSION['showAlert'] = true;
            $_SESSION['user'] = $name;
            $_SESSION['signup'] = true;
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
    <title>Pizzata | Signup Account</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../alert.css">
    <link rel="stylesheet" href="../user.css">
</head>

<body>
    <div class="form">
        <!-- REGISTER ACCOUNT FORM -->

        <form action="signup.php" method="post" >
            <div class="center mt-2">
                <h2>WELCOME TO <span class="main-color">PIZZATA</span> </h2>
                <h2 class="my-1 center">REGISTER HERE</h2>
            </div>
            <div class="my-1 with-100p">
                <input type="text" name="username" autocomplete="off" minlength="3" maxlength="15"
                    placeholder="User Name" class=" p-1  width-100p">
            </div>
            <div class="my-1 with-100p">
                <input type="email" name="email" placeholder="Email" minlength="14" maxlength="50"
                    class=" p-1  width-100p">
            </div>
            <div class="my-1 with-100p">
                <input type="tel" name="contact" maxlength="15" minlength="11" placeholder="Contact"
                    class=" p-1  width-100p">
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="password" maxlength="20" minlength="8" placeholder="Password"
                    class=" p-1 passwd width-100p">
                <button role="button" type="button" class="showHide  d-none">SHOW</button>
            </div>
            <div class="my-1 with-100p relative">
                <input type="password" name="cpassword" maxlength="20" minlength="8" placeholder="Confirm Password"
                    class=" p-1 passwd width-100p">
                <button role="button" type="button" class="showHide  d-none">SHOW</button>
                <small class="pt-1 main-color">Both Passwords should be same</small>
            </div>
            <div class="mt-2 mb-1 center">
                <div class="my-min center">
                    <a class="main-color" href="/pizzashop/routes/login.php">Already Have an Account Login</a>
                </div>
                <input type="submit" value="REGISTER" class="btn">
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
<!-- <script src="main.js"></script> -->

</html>