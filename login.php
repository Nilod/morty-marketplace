<?php
session_start();

if (isset($_SESSION['login'])) {
    header ('location: marketplace.php');
}

$login_valide = "login";
$pwd_valide = "pwd";

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) {
// on vérifie les informations saisies
    if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
        // on enregistre les paramètres de notre visiteur comme variables ession ($login et $pwd) (
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['pwd'] = $_POST['pwd'];

        $_SESSION['panier'] = array();
        // on redirige notre visiteur vers une page de notre section membre
        header ('location: marketplace.php');
    }
    else {
        echo '<body onLoad="alert(\'Identifiants incorrects ...\')">';
        // puis on le redirige vers la page d'accueil
        echo '<meta http-equiv="refresh" content="0;URL=login.php">';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
    <title>Morty Marketplace</title>
</head>
<body>
    <header>
        <h1>Morty Marketplace | Login</h1>
    </header>
    <main>
        <form action="login.php" method="post">
            Votre login : <input type="text" name="login">
            <br />
            Votre mot de passe : <input type="password" name="pwd"><br />
            <input type="submit" value="Connexion">
        </form>
    </main>
</body>