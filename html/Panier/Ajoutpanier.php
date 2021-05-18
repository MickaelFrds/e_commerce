<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupUser = $bdb->prepare('SELECT * FROM client WHERE nom = ? AND pass = ?');
$recupUser->execute(array($_SESSION['nom'], $_SESSION['pass']));
if (!($recupUser->rowCount() > 0)){
    header('Location:Loginclient.php');
}
$idProduit = $_GET['id'];
$quantite =1;
$date = date('Y-m-d');
$ajoutPanier = $bdb->prepare('INSERT INTO commande VALUES (NULL,?,?,?,?)');
$ajoutPanier->execute(array($idProduit,$_SESSION['id'],$quantite,$date));
header('Location:panier.php');
?>