<?php
session_start();
if (!isset($_SESSION['login'])) {
    header ('location: login.php');
}

if (!isset($_GET['id'])) {
    echo 'Article non spécifié.';
    exit;
}

$articles = json_decode(file_get_contents("articles.json"), true);

if (!isset($articles[$_GET['id']])) {
    echo 'Article inexistant.';
    exit;
}

$article = $articles[$_GET['id']];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' type='text/css' href='style.php' media='all'>
    <title>Morty Marketplace | <?php echo $article["libelle"]; ?></title>
</head>
<body>
    <header>
        <a href="marketplace.php" class="btn-accueil"><h1>Morty Marketplace</h1></a>
        <a href="panier.php">Panier</a>
        <a href="logout.php">Logout</a>
    </header>
    <main>
        <section id="article-detail">
            <div class="article-detail">
                <img src="images/<?php echo $article['image']; ?>" alt=""><br>
                <strong><?php echo $article['libelle']; ?></strong><br>
                <?php echo $article['description']; ?><br>
                <em>Prix : <?php echo $article['prix']; ?> €</em><br>
                <form action="panier.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    Quantité : <input type="number" name="quantite" value="1" min="1"><br>
                    <input type="submit" value="Ajouter au panier">
                </form>
            </div>
        </section>
    </main>