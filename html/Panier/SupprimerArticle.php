<?php
session_start();
$idProduit =$_GET['id'];
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$SupArticlePanier= $bdb->prepare('DELETE FROM commande WHERE idproduit = ?');
$SupArticlePanier->execute(array($idProduit));
header("Location:panier.php");
?>