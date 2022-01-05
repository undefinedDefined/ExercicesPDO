<html>
<head>
<title>Clients eCommerce</title>
<style>
    table{
        width: 900px;
        margin: 2rem auto;
    }

    a{
        text-decoration: none;
        color: black;
    }

    td{
        text-align: center;
    }

    table tr:nth-of-type(odd){
        background: #D8E3E5;
    }

</style>
</head>

<body>
<?php

// fichier de configuration 

include_once("config.php");


// On crée le tableau
echo '<table border="1">';

//     Version manuelle pour créer les colonnes d'en tête
//     echo '<tr>';
//         echo '<td>idclient</td>';
//         echo '<td>Nom</td>';
//     echo '</tr>';

// Commande PHP pour récupérer le nom des colonnes dans la BDD

$x = $dbh->prepare("SELECT client.idclient, nom, email, telephone
                    FROM client
                    INNER JOIN adresse ON adresse.idadresse = client.idadresse
                    LIMIT 1");
$x->execute();

// On insère le nom de chaque colonne selectionnée dans une colonne différente

foreach($x->fetchAll(PDO::FETCH_ASSOC) AS $row){
    echo '<tr>';

    $columnName = array_keys($row);
    for($i=0; $i< count($columnName); $i++){
        echo '<td>'.$columnName[$i].'</td>';
    }
    //On ajoute manuellement la colonne détails
    echo '<td>Plus d\'informations</td>';

    echo '</tr>';
}



// Commande PHP pour récupérer les informations des clients dans la BDD

$stmt = $dbh->prepare("SELECT client.* FROM client INNER JOIN adresse ON adresse.idadresse = client.idadresse");
$stmt -> execute();

// Pour chaque client, on crée une nouvelle ligne dans le tableau et on y insère chaque donnée dans une colonne différente

foreach($stmt->fetchAll(PDO::FETCH_NUM) AS $index){
    echo '<tr>';

    //    Version manuelle pour ajouter les données des clients dans chaque colonne
    //    echo '<td>'.$index[0].'</td>';
    //    echo '<td>'.$index[1].'</td>';
    //    echo '<td>'.$index[2].'</td>';
    //    echo '<td>'.$index[3].'</td>';

    for($i=0; $i < count($index); $i++){
        if($i != 4){echo '<td>'.$index[$i].'</td>';}
    }
    echo '<td><a href="client.php?id='.$index[0].'" target="_blank">détails</a></td>';

    echo '</tr>';
}

echo '</table>'

?>
</body>
