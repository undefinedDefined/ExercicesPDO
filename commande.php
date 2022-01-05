<html>
<head>
<title>Page commande</title>
<style>
table{
width: 400px;
margin: 2rem auto;
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

$dbh = new PDO('mysql:host=127.0.0.1;dbname=ecommerce','root','greta');
$nbCommande = $_GET['id'];

if($nbCommande < 1){
    $newURL = 'clients.php';
    header("Location : $newURL");
    die();
}

echo '<table border="1"';

    echo '<tr>';
        echo '<td>idproduit</td>';
        echo '<td>nom</td>';
        echo '<td>prix</td>';
    echo '</tr>';

$stmt = $dbh-> prepare("SELECT produit.idproduit, nom, prix 
FROM commande
INNER JOIN produit_commande ON produit_commande.idcommande = commande.idcommande
INNER JOIN produit ON produit.idproduit = produit_commande.idproduit
WHERE commande.idcommande = :idcommande");
$stmt->bindParam(':idcommande', $nbCommande);
$stmt -> execute();

foreach($stmt->fetchAll(PDO::FETCH_NUM) AS $index){
    echo '<tr>';
    for($i=0; $i< count($index); $i++){
        echo '<td>'.$index[$i].'</td>';
    }
    echo '</tr>';
}

echo '</table>'

?>
</body>
</html>