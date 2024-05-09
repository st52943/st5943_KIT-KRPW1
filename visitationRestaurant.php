<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="stylesheet" href="CSS/visitationRestaurant.css?v=4.0">
</head>
<body>
<?php
session_start();
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
            <li><a href="visitationRestaurant.php">Visit restaurant</a></li>
            <li><a href="logout.php" class="change-text">Login:<span id="username"><?php echo getUsername(); ?></span> </a></li>
        </ul>
    </div>
</div>

<div class="container">
<?php
$servername = "mariadb105.r3.websupport.cz";
$username = "restaurantsp";
$password = "Restaurant1";
$dbname = "restaurantsp";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// Nastavení režimu výjimek pro zobrazení chyb
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Funkce pro zjištění aktuálního uživatelského jména

    $stmt = $conn->prepare("SELECT Name, Specialization, OpeningHours, Town, LunchMenu, WC FROM Restaurant");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        // Výpis dat do dlaždic každé nové restaurace
        foreach ($result as $row) {
            echo "<div class='tile'>";
            echo "<h2>" . $row["Name"] . "</h2>";
            echo "<p>Specialization: " . $row["Specialization"] . "</p>";
            echo "<p>Mo-Su : " . $row["OpeningHours"] . "</p>";
            echo "<p>Town: " . $row["Town"] . "</p>";

            //Zda má restaurace obědové menu a toalety
            if ($row['LunchMenu'] == 1)
            {
                echo "<p>Lunch menu: Yes</p>";
            }
            else
            {
                echo "<p>Lunch menu: No</p>";
            }

            if ($row['WC'] == 1)
            {
                echo "<p>WC: Yes</p>";
            }
            else
            {
                echo "<p>WC: No</p>";
            }
            echo "</div>";
        }
    } else {
        echo "0 results";
    }


    exit();
} catch(PDOException $e) {
    echo "Chyba: " . $e->getMessage();
}
?>
</div>

</body>
</html>