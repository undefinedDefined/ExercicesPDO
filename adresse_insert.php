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
 <label>Adresse : </label><input type="text" name="adresse" required/>
 <label>Ville : </label><input type="text" name="ville" required/>
 <label>Pays : </label><input type="text" name="pays" required/>
 <input type="submit" value="OK">
</form>
<?php

include_once("config.php");

$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];

if(isset($_POST['adresse']) AND !empty($_POST['adresse'])){
    $stmt = $dbh -> prepare("INSERT INTO adresse (ville, pays, adresse) VALUES ('$ville','$pays','$adresse')");
    $stmt -> execute();
    
    echo '<p>Adresse "'.$adresse.'" ajoutée dans la BDD !</p>';
}
?>
</body>
</html>