<?php
session_start();
$idproduit=$_GET['id'];
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$PlusQuantite =$bdb->prepare('SELECT * FROM commande WHERE idproduit =?');
$PlusQuantite->execute(array($idproduit));
$produit = $PlusQuantite->fetch();
if (!($produit['quantité'] == 0)){
    $Quantite = $produit['quantité'] - 1;
    $PlusQuantite =$bdb->prepare('UPDATE commande SET quantité=? WHERE idproduit=?');
    $PlusQuantite->execute(array($Quantite,$idproduit));
}
header('Location: panier.php');
?>