<?php
session_start();
$servername = "mariadb105.r3.websupport.cz";
$username = "restaurantsp";
$password = "Restaurant1";
$dbname = "restaurantsp";

try {
    //připojení dle přihl. údajů viz výše
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Nastavení režimu výjimek pro zobrazení chyb
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Získání dat z formuláře registrace
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $opening = $_POST['opening'];
    $town = $_POST['town'];
    $description = $_POST['description'];
    $agreeLunchMenu = isset($_POST['agreeLunchMenu']);
    $agreeToilets = isset($_POST['agreeToilets']);

    // Připravený SQL dotaz pro vložení nové restaurace do databáze
    $stmt = $conn->prepare("INSERT INTO Restaurant (Name, Specialization, OpeningHours, Town, LunchMenu, WC) VALUES (:name, :specialization, :opening, :town, :agreeLunchMenu, :agreeToilets)");

    // Vazba hodnot na parametry
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':specialization', $specialization);
    $stmt->bindParam(':opening', $opening);
    $stmt->bindParam(':town', $town);
    $stmt->bindParam(':agreeLunchMenu', $agreeLunchMenu);
    $stmt->bindParam(':agreeToilets', $agreeToilets);
    //$stmt->bindParam(':description', $description);

    // Provedení vložení uživatele do databáze
    $stmt->execute();

    // Pokud vložení proběhlo úspěšně, přesměrujte uživatele na přihlašovací stránku
    header("Location: registerRestaurantSuccess.php");
    exit();
} catch(PDOException $e) {
    echo "Chyba: " . $e->getMessage();
}
?>