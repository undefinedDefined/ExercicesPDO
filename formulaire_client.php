<?php
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire client</title>
</head>
<body>

<form action="" method="post">
    <label for="nom">Nom :</label><input type="text" name="nom" id="nom" required> <br>
    <label for="email">Email :</label><input type="email" name="email" id="email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" placeholder="email@example.com" required> <br>
    <label for="">Téléphone :</label><input type="tel" name="phone" id="phone" pattern="[0]{1}[1-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="061122334455" required> <br>

    <label for="adresse">Adresse :</label>
    <select name="adresse" id="adresse">
        <option value="">--Choisir une adresse--</option>
        <?php

        $stmt = $dbh -> prepare("SELECT DISTINCT adresse FROM adresse");
        $stmt -> execute();
        foreach($stmt -> fetchAll(PDO::FETCH_NUM) AS $index){
            echo '<option value="'.$index[0].'">'.$index[0].'</option>';
        }

        ?>

    </select>
    
    <input type="submit" value="Confirmer">

</form>

<?php

if(isset($_POST['nom']) AND !empty($_POST['nom'])){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adresse = $_POST['adresse'];
    $idadresse = "";

    $sth = $dbh ->prepare("SELECT idadresse FROM adresse WHERE adresse = '$adresse'");
    $sth -> execute();
    foreach($sth -> fetchAll(PDO::FETCH_NUM) AS $row){$idadresse = $row[0];}

    $stmt = $dbh -> prepare("INSERT INTO client (nom, email, telephone, idadresse) VALUES ('$nom', '$email', $phone, $idadresse)");
    $stmt -> execute();
    echo '<p>Client '.$nom.' ajouté à la BDD</p>';

}
?>
    
</body>
</html>