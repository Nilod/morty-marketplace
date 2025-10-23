<?php
session_start();

if (isset($_SESSION['login'])) {
    header ('location: marketplace.php');
}
else {
    header ('location: login.php');
}
?>