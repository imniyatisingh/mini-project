<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Pizzata </title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Utility.css">
    <link rel="stylesheet" href="../user.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <?php
    include("../partials/header.php");
    include("../partials/alert.php");
    include("../partials/dbconnect.php");
    $user_ = $_SESSION['user'];
    $sql = "SELECT * FROM `users` WHERE `user_name` = '$user_'";
    $res = mysqli_query($conn, $sql);
    $User = mysqli_fetch_assoc($res);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $opass = $_POST['opassword'];
        $cpass = $_POST['cpassword'];
        $pass = $_POST['password'];

        // hashing new pass
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        if ($cpass == $pass) {
            $sql = "SELECT * FROM `users` WHERE `user_name` = '$name'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $rows = mysqli_num_rows($res);
            if ($rows > 0) {
                $check = password_verify($opass, $row['user_password']);
                if ($check) {
                    $sql = "UPDATE `users` SET `user_password` = '$hash' WHERE `users`.`user_name` = '$name'";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                        showAlert('account updated successfully', 'error');
                        echo '<script>
                        setTimeout(() => {
                            location.href = "/pizzashop/routes/logout.php"
                        }, 2000);
                                                </script>';
                    } else {
                        showAlert('error updating account', 'error');
                    }
                } else {
                    showAlert('invalid old password', 'error');
                }
            } else {
                showAlert('invalid user name', 'error');
            }


        } else {
            showAlert('passwords do not match', 'error');
        }
    }
    ?>
    <div class="form direction-col">
        <form action="update_profile.php" method="post" class="update_form">
            <h2 class="my-2 center">Update Profile</h2>
            <div class="flex gap-1">
                <div class="width-50p">
                    <div class="my-1 with-100p">
                        <fieldset class=" p-min">
                            <legend>
                                Email
                            </legend>
                            <input type="email" value="<?php echo $User['user_email'] ?>" name="email"
                                autocomplete="off" maxlength="15" placeholder="name@example.com"
                                class=" p-0  width-100p">
                        </fieldset>
                    </div>
                    <div class="my-1 with-100p">
                        <fieldset class=" p-min">
                            <legend>
                                User Name
                            </legend>
                            <input type="text" value="<?php echo $User['user_name'] ?>" name="username"
                                autocomplete="off" maxlength="15" placeholder="eg.alex21" class=" p-0  width-100p">
                        </fieldset>
                    </div>
                    <div class="my-1 with-100p">
                        <fieldset class=" p-min">
                            <legend>
                                Contact
                            </legend>
                            <input type="tel" value="<?php echo '0' . $User['user_contact'] ?>" name="contact"
                                autocomplete="off" maxlength="15" placeholder="03******34" class=" p-0  width-100p">
                        </fieldset>
                    </div>

                </div>
                <div class="width-50p">
                    <div class="my-1 with-100p">
                        <fieldset class="relative p-min">
                            <legend>
                                Old password
                            </legend>
                            <input type="password" placeholder="Alex@old" name="opassword" autocomplete="off" maxlength="15"
                                class=" p-0 passwd  width-100p">
                            <button type="button" role="button" onclick="handleShow()"
                                class="showHide d-none ">SHOW</button>
                        </fieldset>
                    </div>
                    <div class="my-1 with-100p">
                        <fieldset class=" p-min relative">
                            <legend>
                                New password
                            </legend>
                            <input type="password" name="password" autocomplete="off" maxlength="15"
                                placeholder="Alex@1234" class=" p-0 passwd  width-100p">
                            <button type="button" role="button" onclick="handleShow()"
                                class="showHide d-none">SHOW</button>
                        </fieldset>
                    </div>
                    <div class="my-1 with-100p">
                        <fieldset class=" p-min relative">
                            <legend>
                                Confirm new password
                            </legend>
                            <input type="password" name="cpassword" autocomplete="off" maxlength="15"
                                placeholder="Alex@1234" class=" p-0 passwd  width-100p">
                            <button type="button" role="button" onclick="handleShow()"
                                class="showHide d-none ">SHOW</button>
                        </fieldset>
                    </div>

                </div>
            </div>
            <input type="submit" value="UPDATE" class="btn mt-2" />
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
    let showHideBtns = Array.from(document.querySelectorAll(".showHide"));
    let passwds = Array.from(document.querySelectorAll(".passwd"));
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
<script src="../main.js"></script>

</html>