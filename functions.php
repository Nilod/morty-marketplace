<?php
// nombre d'articles sur une ligne
$TAILLE_LIGNE = 3;
// Taille des vignettes sur le marketplace
$L_VIGNETTE = 200;
$H_VIGNETTE = 200;

function creerVignette($lVignette, $hVignette, $fullNomImage) {
    $dossierVignettes = "images/vignettes/";
    $cheminImage = "images/" . $fullNomImage;

    $nomImage = pathinfo($cheminImage, PATHINFO_FILENAME);
    $cheminVignette = $dossierVignettes . $nomImage . "_vignette.jpeg";

    // Si la vignette existe déjà on la renvoie directement
    if (file_exists($cheminVignette)) {
        return $cheminVignette;
    }

    // création de la vignette (produit une erreur si le format ne corrspond pas à une fonction imagecreatefromXXX)
    $extension = strtolower(pathinfo($cheminImage, PATHINFO_EXTENSION));
    $imagecreatefrom = "imagecreatefrom" . $extension;
    $source = $imagecreatefrom($cheminImage);
    /* Une autre solution : 
    // Switch pour charger tous les types d'image
    $extension = strtolower(pathinfo($cheminImage, PATHINFO_EXTENSION));
    switch ($extension) {
        case 'jpg':
            $source = imagecreatefromjpeg($cheminImage);
            break;
        case 'jpeg':
            $source = imagecreatefromjpeg($cheminImage);
            break;
        case 'png':
            $source = imagecreatefrompng($cheminImage);
            break;
        case 'webp':
            $source = imagecreatefromwebp($cheminImage);
            break;
        default:
            return "images/logo-iut.jpg"; // Logo iut si le format est pas dans la liste
    } */

    // dimensions image
    $lSrc = imagesx($source);
    $hSrc = imagesy($source);

    // création vignette
    $vignette = imagecreatetruecolor($lVignette, $hVignette);
    imagecopyresampled($vignette, $source, 0, 0, 0, 0, $lVignette, $hVignette, $lSrc, $hSrc);

    // sauvegarde de la vignette en jpeg
    imagejpeg($vignette, $cheminVignette, 90);

    imagedestroy($source);
    imagedestroy($vignette);
    return $cheminVignette;
}

function afficherArticles() {
    global $TAILLE_LIGNE;
    global $H_VIGNETTE;
    global $L_VIGNETTE;
    $articles = file_get_contents("articles.json");
    $articles = json_decode($articles);
/*
    $nbArticles = count($articles);
    // vérifie que nbArticles est divisible par le nombre d'articles sur une ligne
    $nbLignes = floor($nbArticles / $TAILLE_LIGNE);
    if ($nbArticles%$TAILLE_LIGNE != 0) {
        $nbLignes += 1;
    }
    
    $indArticle = 0;
    for ($indLigne = 0; $indLigne < $nbLignes; $indLigne++) {
        echo "<div class='row-articles'>\n";
        for ($j = 0; $j < $TAILLE_LIGNE && $indArticle < $nbArticles; $j++) {
            echo "<div id='article$indArticle' class='article'>\n";
            echo "<img src='" . creerVignette($L_VIGNETTE, $H_VIGNETTE, $articles[$indArticle]->image) . "' alt=''>" . "<br>\n";
            echo $articles[$indArticle]->libelle . "<br>\n";
            echo $articles[$indArticle]->description . "<br>\n";
            echo "</div>\n";
            $indArticle++;
        }
        echo "</div>\n";
    }
        */
    $col = 0;

    foreach ($articles as $id => $article) {
        if ($col == 0) {
            echo "<div class='row-articles'>\n";
        }

        echo "<a href='article.php?id=$id' class='lien-article article'>\n";
        echo "<div id='article$id' class=''>\n";
        echo "<img src='" . creerVignette($L_VIGNETTE, $H_VIGNETTE, $article->image) . "' alt=''><br>\n";
        echo "<strong>" . $article->libelle . "</strong><br>\n";
        echo $article->description . "<br>\n";
        echo "</div>\n";
        echo "</a>\n";
        
        $col++;
        if ($col >= $TAILLE_LIGNE) {
            echo "</div>\n"; // fermer la ligne
            $col = 0;
        }
    }
}
?>