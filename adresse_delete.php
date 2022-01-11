<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE adresse</title>
</head>
<body>
    
<form action="" method="POST">
    <label for="adresse">Adresse à supprimer :</label> <input type="number" name="adresse" id="adresse" min="1" max="255">
    <input type="submit" value="Confirmer">
</form>
<?php

include_once('config.php');

$idadresse = $_POST['adresse'];

if(isset($_POST['adresse']) AND !empty($_POST['adresse'])){
$stmt = $dbh -> prepare("DELETE FROM adresse WHERE idadresse = $idadresse");
$stmt -> execute();

echo '<p>Adresse numéro '.$idadresse.'supprimée de la BDD</p>';
}
?>
</body>
</html>