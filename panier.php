<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header ('location: login.php');
}

/* 
Créer un array avec les articles : arcticle1 -> nombre, article2 -> nombre, ...

*/
?>