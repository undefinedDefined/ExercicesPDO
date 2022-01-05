<html>
<head>
<title>Commandes eCommerce</title>
<style>
    table{
        width: 400px;
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

// On récupère l'ID du client pour afficher ses commandes plus tard

$nbClient = $_GET['id'];

// On redirige l'utlisateur vers clients.php si l'url a été entrée manuellement

// if($nbClient < 1){
//     $newURL = 'clients.php';
//     header("Location: $newURL");
//     die();
// }

// On affiche toutes les commandes si l'url est rentrée manuellement dans le navigateur 

if($nbClient < 1){
    echo '<table border="1">';

    $x = $dbh -> prepare("  SELECT client.idclient, nom, idcommande, date, libelle
                            FROM client 
                            INNER JOIN commande ON commande.idclient = client.idclient 
                            INNER JOIN etat ON etat.idetat = commande.idetat
                            LIMIT 1");
    $x-> execute();

    echo '<tr>';
    foreach($x->fetchAll(PDO::FETCH_ASSOC) AS $row){
        $columnName = array_keys($row);
        for($i=0; $i< count($columnName); $i++){
            echo '<td>'.$columnName[$i].'</td>';
        }
    }
    echo '</tr>';

    $stmt = $dbh -> prepare("   SELECT client.idclient, nom, idcommande, date, libelle
                                FROM client 
                                INNER JOIN commande ON commande.idclient = client.idclient 
                                INNER JOIN etat ON etat.idetat = commande.idetat");
    $stmt -> execute();
    foreach($stmt->fetchAll(PDO::FETCH_NUM) AS $index){
        echo '<tr>';
        for($i=0; $i< count($index); $i++){
            if($i == 1){echo '<td><a href="client.php?id='.$index[0].'">'.$index{$i}.'</a></td>';}
            else{echo '<td>'.$index[$i].'</td>';}
        }
        echo '</tr>';
    }

    echo '</table>';
    die();
}
// On crée le tableau 

echo '<table border="1">';

// Ajout manuellement des colonnes de l'en tête
// echo '<tr>';
//     echo '<td>idcommande</td>';
//     echo '<td>date</td>';
//     echo '<td>Etat</td>';
// echo '</tr>';

$x =  $dbh-> prepare("  SELECT idcommande, date 
                        FROM commande 
                        INNER JOIN etat ON etat.idetat = commande.idetat
                        LIMIT 1");
$x->execute();

// On insère le nom de chaque colonne selectionnée dans une colonne différente

echo '<tr>';
foreach($x->fetchAll(PDO::FETCH_ASSOC) AS $row){
    $columnName = array_keys($row);
    for($i=0; $i< count($columnName); $i++){
        echo '<td>'.$columnName[$i].'</td>';
    }
    // On ajoute manuellement la colonne Etat qui sera représentée par l'état de la commande
    echo '<td>Etat</td>';
}
echo '</tr>';

// Commande PHP pour récupérer les informations de chaque commande dans la BDD

$stmt = $dbh->prepare("SELECT idcommande, date, libelle FROM commande INNER JOIN etat ON etat.idetat = commande.idetat WHERE idclient = :idclient ORDER BY date ASC");
$stmt->bindParam(':idclient', $nbClient);
$stmt -> execute();

// On crée une nouvelle ligne pour chaque commande et une nouvelle colonne pour chaque donnée d'une commande
foreach($stmt->fetchAll(PDO::FETCH_NUM) AS $index){
    echo '<tr>';
        for($i=0; $i< count($index); $i++){
            if($i == 0){echo '<td><a href="commande.php?id='.$index[$i].'" target="_blank">'.$index[$i].'</a></td>';}
            else{echo '<td>'.$index[$i].'</td>';}
        }
    echo '</tr>';
}

echo '</table>'
?>

</body>
</html>