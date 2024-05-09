<?php
//Odhlášení
session_start();
$_SESSION = array();
session_destroy();
header("location: Login.html");
exit;
?>