<?php
session_start()
?>
<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="register.php">Register Account</a>
    </li>
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        ?>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php
    }
    ?>
</ul>