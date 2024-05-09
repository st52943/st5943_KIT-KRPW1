<?php
session_start();
$servername = "mariadb105.r3.websupport.cz";
$username = "restaurantsp";
$password = "Restaurant1";
$dbname = "restaurantsp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Nastavení režimu výjimek pro zobrazení chyb
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Získání dat z formuláře registrace
    $username = $_POST['username'];
    $password = $_POST['password'];
    $license = $_POST['license'];
    $role = 2; // Předpokládáme, že nově registrovaní uživatelé mají role 2 (User)

    // Připravený SQL dotaz pro vložení nového uživatele do databáze
    $stmt = $conn->prepare("INSERT INTO Users (UsersRole_ID, username, password, license ) VALUES (:role, :username, :password, :license)");

    // Vazba hodnot na parametry
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':license', $license);
    $stmt->bindParam(':role', $role);

    // Provedení vložení uživatele do databáze
    $stmt->execute();

    // Pokud vložení proběhlo úspěšně, přesměruje uživatele na přihlašovací stránku
    header("Location: registerSuccess.php");
    exit();
} catch(PDOException $e) {
    echo "Chyba: " . $e->getMessage();
}
?>