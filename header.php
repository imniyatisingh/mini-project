<?php
session_start();
echo '
<header>
    <div class="logo">
        <h2><a href="/pizzashop/">Piz<span >zata</span></a></h2>
    </div>
    <nav>
        <ul class="navigation flex">
            <li class="mx-min">
                <a class="p-min nav-links " href="/pizzashop/">Home</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links " href="/pizzashop/routes/about.php">About</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links "  href="/pizzashop/routes/contact.php">Contact</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links " href="/pizzashop/routes/orders.php">Orders</a>
            </li>
            <li class="mx-min">
                <a class="p-min nav-links " href="/pizzashop/routes/faq.php">Faq</a>
            </li>
        </ul>
    </nav>
    <div class="acounting">
        <a href="/pizzashop/routes/cart.php"><i class="uil exsmall-font main-color
             uil-shopping-bag"></i></a>
             <i id="dropdown" class="uil pointer exsmall-font main-color
             uil-user"></i>
             <div class="drop">
                 ';
if (!isset($_SESSION['user'])) {
    echo '<a href="/pizzashop/routes/signup.php" class="btn-1 btn my-min">REGISTER</a>
                            <a href="/pizzashop/routes/login.php" class="btn-2 btn my-min">LOGIN</a>';
} else {
    echo ' <a href="/pizzashop/routes/logout.php" name="logout" class="btn p-font my-min block max">LOGOUT</a>
    <a href="/pizzashop/routes/aboutme.php" name="logout" class="btn p-font my-min block max">ABOUT ME</a>
    <a href="/pizzashop/routes/update_profile.php" class="btn p-font my-min block max btn-dark">UPDATE PROFILE</a>';
}

echo '</div>
    </div>
</header>';
echo '<script src="../main.js"></script>';
?>