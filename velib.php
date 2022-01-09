<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Mes styles CSS */
    </style>
</head>

<body>



<?php
// fichier de configuration
include_once("config.php");

// On crée le tableau
echo '<table border="1">';

// La première ligne avec le nom des colonnes
echo '<tr>';
echo '<td>idlocation</td>';
echo '<td>station depart</td>';
echo '<td>station arrivée</td>';
echo '</tr>';

// $x = 1;

for($i = 500; $i < 526 ; $i++){

echo '<tr>';

$stmt = $dbh -> prepare("SELECT idlocation FROM location WHERE idlocation = '$i'");
$stmt -> execute();
foreach($stmt -> fetchAll(PDO::FETCH_NUM) AS $row){
    echo '<td>'.$row[0].'</td>';
}

$stmt = $dbh->prepare("SELECT lieu
FROM station
WHERE idstation = ( 
	SELECT station_depart
	FROM location
	WHERE idlocation = '$i')
OR idstation = ( 
	SELECT station_arrivee
	FROM location
	WHERE idlocation = '$i');");
$stmt -> execute();

foreach($stmt -> fetchAll(PDO::FETCH_NUM) AS $row){
    echo '<td>'.$row[0].'</td>';
}

echo '</tr>';
}

echo '</table>';
?>
</body>
</html>
