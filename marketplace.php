<?php
session_start();

if (!isset($_SESSION['login'])) {
    header ('location: login.php');
}

require("functions.php")
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' type='text/css' href='style.php' media='all'>
    <title>Morty Marketplace</title>
</head>
<body>
    <header>
        <a href="marketplace.php" class="btn-accueil"><h1>Morty Marketplace</h1></a>
        <a href="panier.php">Panier</a>
        <a href="logout.php">Logout</a>
    </header>
    <main>
        <section id="articles" class="articles">
            <?php afficherArticles(); ?>
        </section>
    </main>
</body>