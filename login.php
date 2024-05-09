<?php
//zahájení relace a následný vytvoření proměnných ohledně přístupů do databáze
session_start();
$servername = "mariadb105.r3.websupport.cz";
$username = "restaurantsp";
$password = "Restaurant1";
$dbname = "restaurantsp";

//Samotné připojení a přihlášení dle jména a hesla
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Nastavení režimu výjimek pro zobrazení chyb
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Připravený SQL dotaz s parametrizovanými dotazy pro bezpečnost
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = :username AND password = :password");

    // Vazba hodnot na parametry
    //$stmt->bindParam(':UsersRole_ID', $role);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Nastavení hodnot parametrů z formuláře
    $role = $_POST['UsersRole_ID'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Provedení dotazu
    $stmt->execute();

    // Získání výsledku
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Pokud uživatel existuje v databázi, zkontrolujeme jeho roli
    if ($result) {
        // Kontrola role uživatele
        if ($result['UsersRole_ID'] === 1) {
            //echo 'Owner';
            $_SESSION['logged_in'] = true;
            $_SESSION['user_role'] = 'Owner';
            header("Location: index.php?'username'" . urlencode($username));
            exit();
        } elseif ($result['UsersRole_ID'] === 2) {
            //echo 'User';
            $_SESSION['logged_in'] = true;
            $_SESSION['user_role'] = 'User';
            header("Location: index.php?'username'" . urlencode($username));
            exit();
        } else if ($result['UsersRole_ID'] === 3) {
            //echo 'Admin';
            $_SESSION['logged_in'] = true;
            $_SESSION['user_role'] = 'Admin';
            header("Location: index.php?'username'" . urlencode($username));
            exit();
        }
        else {
            echo 'Neznámá role';
        }
    } else {
        // Pokud uživatel neexistuje v databázi přesměrujeme na loginFail
        header("Location: loginFail.php");
    }
} catch(PDOException $e) {
    echo "Chyba: " . $e->getMessage();
}
?>
