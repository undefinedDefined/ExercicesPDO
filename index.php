<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbh = new PDO('mysql:host=localhost;dbname=ecommerce','root','greta');

$x = $dbh -> prepare("  SELECT *
                            FROM client 
                            INNER JOIN commande ON commande.idclient = client.idclient 
                            INNER JOIN etat ON etat.idetat = commande.idetat
                            LIMIT 1");
$x-> execute();
foreach($x->fetchAll(PDO::FETCH_ASSOC) AS $row){
print_r(array_keys($row));}

// $stmt = $dbh-> prepare("SELECT * FROM produit WHERE idproduit = :idproduit");
// $stmt-> bindParam(':idproduit', $idproduit);
// $idproduit = '5';
// $stmt -> execute();
// print_r($stmt->fetchAll());

// $sth = $dbh-> prepare('SELECT libelle FROM commande INNER JOIN etat ON etat.idetat = commande.idetat');
// $sth -> execute();
// print_r($sth->fetchAll());

// $sth = $dbh-> prepare('SELECT idclient,nom FROM client LIMIT 5');
// $sth -> execute();
// foreach($sth->fetchAll(PDO::FETCH_ASSOC) AS $row){
//     foreach($row AS $champ){
//         print_r($champ." ");
//     }
//     print_r("<br/>");
// }

// $stmt = $dbh-> prepare("SELECT * FROM client WHERE idclient = :idclient");
// $stmt-> bindParam(':idclient', $idclient);
// $idclient = '558';
// $stmt -> execute();
// foreach($stmt->fetchAll(PDO::FETCH_ASSOC) AS $row){
//     foreach($row AS $champ){
//         print_r($champ." ");
//     }
//     print_r("<br/>");
// };

// $stmt = $dbh-> prepare("SELECT nom FROM produit WHERE idproduit = :idproduit");
// $stmt-> bindParam(':idproduit', $idproduit);
// $idproduit = '15';
// $stmt -> execute();
// print_r($stmt->fetchAll());

// $stmt = $dbh-> prepare("SELECT client.idclient, client.nom FROM client INNER JOIN commande ON commande.idclient = client.idclient WHERE idcommande = :idcommande");
// $stmt-> bindParam(':idcommande', $idcommande);
// $idcommande = '741';
// $stmt -> execute();
// print_r($stmt->fetchAll());

// try{ 
//     foreach($dbh -> query('SELECT * FROM etat') AS $row){
//         print_r($row);
//     }
//     $dbh = null;
// } catch (PDOException $e){
//     print "Erreur !:" .$e -> getMessage(). "<br/>";
//     die();
// }


?>