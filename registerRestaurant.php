<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Restaurant</title>
    <link rel="stylesheet" href="CSS/registerRestaurant.css?v=3.6">
</head>
<body>
<?php
session_start();

// Funkce pro zjištění aktuálního uživatelského jména
function getUsername() {
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['user_role'])) {
        return $_SESSION['user_role'];
    }
    return null;
}
?>
<?php
//Odkaz na PHP soubor, který ale obsahuje skript, který dokáže změnit text po najetí myši. PHP kvůli funkci getUsername();
include 'Javascript/Logout.php';
?>
<div class="navMain">
    <div class="navbar">
        <a href="#" class="navbar-brand">My Website</a>
     <ul class="navbar-menu">
            <li><a href="index.php">Home Page</a></li>
            <li><a href="registerRestaurant.php">Register restaurant</a></li>
            <li><a href="logout.php" class="change-text">Login:<span id="username"><?php echo getUsername(); ?></span> </a></li>
     </ul>
    </div>
</div>
<form class="form" action="evidenceRestaurant.php" method="post">
    <p class="title">Register Your Restaurant</p>
    <p class="message"></p>
    <label>
        <input class="input" name="name" placeholder="" required="">
        <span>*Name</span>
    </label>

    <label>
        <input class="input" name="specialization" placeholder="" required="">
        <span>*Specialization (Max 30 characters)</span>
    </label>

    <label>
        <input class="input" name="opening" placeholder="" required="">
        <span>*Opening Hours</span>
    </label>

    <label>
        <input class="input" name="town" placeholder="" required="">
        <span>*Town</span>
    </label>

    <label class="checkbox-container">
        <p>Lunch menu</p>
        <input type="checkbox" name="agreeLunchMenu" class="checkbox">
        <span class="checkmark"></span>
    </label>

    <label class="checkbox-container">
        <p>WC</p>
        <input type="checkbox" name="agreeToilets" class="checkbox">
        <span class="checkmark"></span>
    </label>

    <button class="submit"><a href="evidenceRestaurant.php">Submit</a> </button>
</form>
</body>
</html>