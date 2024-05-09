<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="CSS/index.css?v=3.9">
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
//Funkce pro zjištění role
function getUserRole(){
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['user_role'])) {
        // Pokud je uživatel přihlášen a jeho role je nastavena, vrátíme roli
        return $_SESSION['user_role'];
    }
    // Pokud uživatel není přihlášen nebo jeho role není nastavena, vrátíme null
    return null;
}
?>

<?php
//Odkaz na PHP soubor, který ale obsahuje skript, který dokáže změnit text po najetí myši. PHP kvůli funkci getUsername();
    include 'Javascript/Logout.php';
?>


<div class="navbar">
    <a href="#" class="navbar-brand">My Website</a>
    <ul class="navbar-menu">
        <li><a href="index.php">Home Page</a></li>

        <?php
            //Owner, User a Admin role-práva a zobrazení dle přihlášeného
            $userRole = getUserRole();
            if ($userRole === 'Owner'){
                echo "<li><a href='registerRestaurant.php'> Register restaurant</a></li>";
            }
            else if ($userRole === 'User') {
                echo "<li><a href='visitationRestaurant.php'> Visit restaurant</a></li>";
            }
            else{
                echo "<li><a href='registerRestaurant.php'> Register restaurant</a></li>";
                echo "<li><a href='visitationRestaurant.php'> Visit restaurant</a></li>";
            }

        ?>
        <li><a href="logout.php" class="change-text">Login:<span id="username"><?php echo getUsername(); ?></span> </a></li>
    </ul>
</div>
<div class="container">
    <?php
    //Owner, User a Admin role-práva a zobrazení dle přihlášeného
    if ($userRole === 'Owner'){
        echo "<h2>You are logged in as Owner</h2>";
        echo "<p>You can Register your restaurant, but you can't search any restaurant.</p>";
    }
    else if ($userRole === 'User') {
        echo "<h2>You are logged in as User</h2>";
        echo "<p>You can search restaurant, but you can't register any restaurant.</p>";
    }
    else{
        echo "<h2>You are logged in as Admin</h2>";
        echo "<p>You can do all.</p>";
    }

    ?>
</div>

</body>
</html>