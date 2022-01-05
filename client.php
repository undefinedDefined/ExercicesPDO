<html>
<head>
<title>Page client</title>
<style>
    table{
        width: 800px;
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

// On récupère l'ID du client pour afficher ses informations plus tard

$nbClient = $_GET['id'];

// Redigier l'utilisateur vers la page clients.php si l'url est rentrée manuellement

if($nbClient < 1){
    $newURL = 'clients.php';
    header("Location: $newURL");
    die();
}

// On crée le tableau
echo '<table border="1">';

    // Version manuelle pour ajouter les colonnes voulues
    // echo '<tr>';
    //     echo '<td>Idclient</td>';
    //     echo '<td>Nom</td>';
    //     echo '<td>email</td>';
    //     echo '<td>telephone</td>';
    //     echo '<td>adresse</td>';
    //     echo '<td>Nombre de commandes</td>';
    // echo '</tr>';

// Commande PHP pour récupérer le nom des colonnes dans la BDD

$x = $dbh->prepare("SELECT idclient, nom, ville, pays, adresse
                    FROM client
                    INNER JOIN adresse ON adresse.idadresse = client.idadresse
                    LIMIT 1");
$x->execute();


// On insère le nom de chaque colonne selectionnée dans une colonne différente

echo '<tr>';
    foreach($x->fetchAll(PDO::FETCH_ASSOC) AS $row){
        $columnName = array_keys($row);
        for($i=0; $i< count($columnName); $i++){
            echo '<td>'.$columnName[$i].'</td>';
        }
        
    }
    // On ajoute manuellement la colonne 'nombre de commandes' qui sera représentée par le SELECT count(*)
    echo '<td>Nombre de commandes</td>';
echo '</tr>';


// Commande PHP pour récupérer les informations du client de la BDD

$stmt = $dbh->prepare(" SELECT client.idclient, nom, ville, pays, adresse, count(*)
                        FROM adresse 
                            INNER JOIN client ON client.idadresse = adresse.idadresse 
                            INNER JOIN commande ON commande.idclient = client.idclient
                        WHERE client.idclient= :idclient");
$stmt-> bindParam(':idclient', $nbClient);
$stmt -> execute();


// Pour chaque information du client on crée une nouvelle colonne avec celle-ci

foreach($stmt->fetchAll(PDO::FETCH_NUM) AS $index){
    echo '<tr>';

    //    Version manuelle pour ajouter les données des clients
    //    echo '<td>'.$index[0].'</td>';
    //    echo '<td>'.$index[1].'</td>';
    //    echo '<td>'.$index[2].'</td>';
    //    echo '<td>'.$index[3].'</td>';

    for($i=0; $i < count($index); $i++){
        if($i == 5){ echo '<td><a href="commandes.php?id='.$index[0].'" target="_blank">'.$index[$i].'</a></td>';}
        else {echo '<td>'.$index[$i].'</td>';}
    }

    echo '</tr>';
}

echo '</table>';
?>

</body>
</html>