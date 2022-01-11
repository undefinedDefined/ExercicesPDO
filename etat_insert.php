<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT</title>
</head>
<body>

<p>Ajouter un nouvel état de livraison dans la base de données</p>
<form action="" method="post">
 <label>Votre nom : </label>
 <input type="text" name="libelle" />
 <input type="submit" value="OK">
</form>

<?php
include_once("config.php");

$newEtat = $_POST['libelle'];

if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
    $stmt = $dbh -> prepare("INSERT INTO etat VALUES ('$newEtat')");
    $stmt -> execute();

    echo '<p>Etat "'.$newEtat.'" ajouté à la base de données !</p>';
}
?>
    
</body>
</html>