<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupUser = $bdb->prepare('SELECT * FROM client WHERE nom = ? AND pass = ?');
$recupUser->execute(array($_SESSION['nom'], $_SESSION['pass']));
if (!($recupUser->rowCount() > 0)){
    header('Location:../Client/Loginclient.php');
}
if(isset($_POST['-quantité'])){
    echo salut;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> un site web dynamique de vente en ligne </title>
    <link rel="stylesheet" href="../Style.css">
    <script src="https://kit.fontawesome.com/7b5ea0c554.js" crossorigin="anonymous"></script>
    <script src="ScripPanier.js"></script>
</head>
<body>
<!-- Barre de navigation -->
<nav>
    <h1> Shopping </h1>
    <div class="onglets">
        <a href="../Accueil.html">Accueil </a>
        <a href="../Homme.php"> Homme </a>
        <a href="../Femme.php"> Femme</a>
        <a href="../Enfant.php"> Enfant</a>
        <form>
            <input type="search" placeholder="Recherche">
        </form>
        <a href="../Admin/EspaceAdmin.php" class="fas fa-user-lock"></a>
        <a href="panier.php" class="fas fa-shopping-cart"></a>
        <a href="../Client/EspaceClient.php" class="fas fa-user-circle"></a>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
<!--Header-->
<header>
</header>
<!-- Fin Header-->
<?php
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupPanier = $bdb->prepare('SELECT * FROM commande WHERE idclient = ?');
$recupPanier->execute(array($_SESSION['id']));
?>
<div class="Panier">
    <h1>Panier</h1>
    <table class="Panier">
        <tr>
            <td><h3>Image</h3></td>
            <td><h3>Nom</h3></td>
            <td><h3>Prix unitaire</h3></td>
            <td><h3>Quantité</h3></td>
            <td><h3>Prix</h3></td>
        </tr>
            <?php
            $prixTotal= 0;
            while ($panier = $recupPanier->fetch()){
                $recupArticleFromCommande = $bdb->prepare('SELECT * FROM produit WHERE id =?');
                $recupArticleFromCommande->execute(array($panier['idproduit']));
                $article = $recupArticleFromCommande->fetch();
                ?>
        <tr>
            <td class="ImagePanier"> <img class="ImagePanier" src="<?php echo $article['image'];?>"></td>
            <td class="LignePanier"><?php echo $article['nom'];?></td>
            <td class="LignePanier"><?php echo $article['prix'];?></td>
            <td class="LignePanier">
                <a class="Panier" href="MoinsQuantité.php?id=<?=$article['id'];?>"><button name="+quantité">-</button></a>
                <textarea  name="quantité"><?= $panier['quantité'];?></textarea>
                <a class="Panier" href="PlusQuantité.php?id=<?=$article['id'];?>"><button name="+quantité">+</button></a></td>
            <td class="LignePanier"><?php echo $article['prix']*$panier['quantité']?></td>
            <td class="BoutonPanier"><a class="Modifier" href="SupprimerArticle.php?id=<?=$article['id'];?>"><button type="" name="Supprimer">Supprimer</button></a></td>
        </tr>
            <?php
                $prixTotal = $prixTotal +($article['prix']*$panier['quantité']);
            }
            ?>
        <tr>
            <td><h3>Prix total</h3></td>
            <td><?php echo $prixTotal;?></td>
        </tr>
    </table>
    <br><br>
    <a class="Valider" href="ValiderCommande.php?"><button name="Valider">Valider</button></a>
</div>

</body>
<!--Pied de page-->
<footer>
    <p>&copy; Contactez-nous au 06 00 00 00 00</p>
    <div class="social-media">
        <p><i class="fab fa-facebook-f"></i></p>
        <p><i class="fab fa-twitter"></i></p>
        <p><i class="fab fa-instagram"></i></p>
        <p><i class="fab fa-linkedin-in"></i></p>
    </div>
</footer>
<!--Fin du pied de page-->
</html>
