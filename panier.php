<?php
session_start();

if (!isset($_SESSION['login'])) {
    header ('location: login.php');
}

$articles = json_decode(file_get_contents("articles.json"), true);

// Gestion + et -
if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($_POST['action'] === 'plus') {
        $_SESSION['panier'][$id]++;
    } elseif ($_POST['action'] === 'minus' && $_SESSION['panier'][$id] > 0) {
        $_SESSION['panier'][$id]--;
        if ($_SESSION['panier'][$id] == 0) {
            unset($_SESSION['panier'][$id]);
        }
    }
    header('Location: panier.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' type='text/css' href='style.php' media='all'>
    <title>Panier</title>
</head>
<body>
    <header>
        <a href="marketplace.php" class="btn-accueil header-title"><h1>Morty Marketplace</h1></a>
        <dict class="header-buttons">
            <a href="panier.php" class="btn">Panier</a>
            <a href="logout.php" class="btn">Logout</a>
        </dict>
    </header>
    <h1>Panier</h1>

    <?php
if (empty($_SESSION['panier'])) {
    echo '<p>Panier vide</p>';
} else {
    $totalFinal = 0;
    foreach ($_SESSION['panier'] as $id => $quantite) {
        $id = (string)$id;
        if (isset($articles[$id])) {
            $article = $articles[$id];
            $totalArticle = $article['prix'] * (int)$quantite;
            $totalFinal += $totalArticle;
            echo '<div>';
            echo $article['libelle'] . ' - ' . $article['prix'] . '€ x ';
            // bouton moins
            echo '<form method="post" class="btn-panier">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="hidden" name="action" value="minus">';
            echo '<button type="submit">-</button>';
            echo '</form> ';
            echo ' ' . $quantite . ' ';
            // bouton plus
            echo '<form method="post" class="btn-panier">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="hidden" name="action" value="plus">';
            echo '<button type="submit">+</button>';
            echo '</form>';
            echo ' = ' . $totalArticle . '€';
            echo '</div>';
        }
    }
    echo '<hr>';
    echo '<div><strong>Total : ' . $totalFinal . "€</strong></div>";
}
?>
</body>
</html>