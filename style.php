<?php 
    header('content-type: text/css');
    require("functions.php"); 
    $TAILLE_ARTICLE = (1/$TAILLE_LIGNE)*100;
?>

header {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.header-title {

}

.header-buttons {
  margin-left: auto;
  gap: 10px;
}

.btn {
  display: inline-block;
  background-color: grey;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
}

a.btn-accueil,
a.btn-accueil:visited {
  color: black;
  text-decoration: none;
}

a.lien-article,
a.lien-article:visited {
    color: black;
    text-decoration: none;
}

.btn:hover {
  background-color: darkgrey;
}

.articles {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.row-articles {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    flex-wrap: wrap; 
    gap: 10px;

}

.article {
    flex: 0 1 calc(<?php echo $TAILLE_ARTICLE?>% - 0px); /*0: peut pas grandir 0: peut pas rétrecir */
    max-width: calc(<?php echo $TAILLE_ARTICLE?>% - 10px);
    padding: 10px;
    text-align: left;
    box-sizing: border-box;
    border: 2px solid black;
}

