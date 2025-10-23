<?php
session_start();
if (!isset($_SESSION['login'])) {
    header ('location: login.php');
}

if (!isset($_GET['id'])) {
    echo 'Article non spécifié.';
    exit;
}

$idArticle = $_GET['id'];

$articles = json_decode(file_get_contents("articles.json"), true);

if (!isset($articles[$idArticle])) {
    echo 'Article inexistant.';
    exit;
}

if (isset($_POST['ajoutPanier'])) {
    // Ajouter l'article au panier
    if (!isset($_SESSION['panier'][$idArticle])) {
        $_SESSION['panier'][$idArticle] = 0;
    }
    $_SESSION['panier'][$idArticle] += 1;

    echo '<body onLoad="alert(\'Article ajouté au panier.\')">';
    echo '<meta http-equiv="refresh" content="0;URL=article.php?id=' . $idArticle . '">';
}

$article = $articles[$idArticle];
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
        <a href="marketplace.php" class="btn-accueil header-title"><h1>Morty Marketplace</h1></a>
        <dict class="header-buttons">
            <a href="panier.php" class="btn">Panier</a>
            <a href="logout.php" class="btn">Logout</a>
        </dict>
    </header>
    <main>
        <section id="article-detail">
            <div class="article-detail">
                <img src="images/<?php echo $article['image']; ?>" alt=""><br>
                <strong><?php echo $article['libelle']; ?></strong><br>
                <p><?php echo $article['description']; ?></p>

                <ul class="caracteristiques">
                    <li><strong>Taille :</strong> <?php echo $article['taille']; ?> cm</li>
                    <li><strong>Poids :</strong> <?php echo $article['poids']; ?> kg</li>
                    <li><strong>Note :</strong> <?php echo $article['note']; ?>/5</li>
                </ul>

                <em>Prix : <?php echo $article['prix']; ?> €</em><br>

                <form action="article.php?id=<?php echo $idArticle; ?>" method="post">
                    <input type="hidden" name="ajoutPanier" value="true">
                    <input type="submit" value="Ajouter au panier">
                </form>
            </div>
        </section>
    </main>