<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT adresse</title>
</head>
<body>


<p>Ajouter une nouvelle adresse dans la base de données</p>
<form action="" method="post">
 <label>Nom : </label><input type="text" name="nom" required/>
 <label>Prix : </label><input type="number" name="prix" min="1" step=".01" required/>
 <input type="submit" value="OK">
</form>
<?php

include_once("config.php");

$nom = $_POST['nom'];
$prix = $_POST['prix'];

if(isset($_POST['nom']) AND !empty($_POST['nom'])){
    $stmt = $dbh -> prepare("INSERT INTO produit (nom, prix) VALUES ('$nom','$prix')");
    $stmt -> execute();
    
    echo '<p>Produit "'.$nom.'" ajoutée dans la BDD !</p>';
}
?>
</body>
</html>