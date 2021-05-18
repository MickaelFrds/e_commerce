<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> un site web dynamique de vente en ligne </title>
    <link rel="stylesheet" href="Style.css">
    <script src="https://kit.fontawesome.com/7b5ea0c554.js" crossorigin="anonymous"></script>
</head>
<body>
<!-- Barre de navigation -->
<nav>
    <h1> Shopping </h1>
    <div class="onglets">
        <a href="Accueil.html">Accueil </a>
        <a href="Homme.php"> Homme </a>
        <a href="Femme.php"> Femme</a>
        <a href="Enfant.php"> Enfant</a>
        <form>
            <input type="search" placeholder="Recherche">
        </form>
        <a href="Admin/EspaceAdmin.php" class="fas fa-user-lock"></a>
        <a href="Panier/panier.php" class="fas fa-shopping-cart"></a>
        <a href="Client/EspaceClient.php" class="fas fa-user-circle"></a>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
<!--Header-->
<header>

</header>
<!-- Fin Header-->
<!--contenu-->
<div class="containerZone">
    <div class="regform">
        <h1> Articles Femme </h1>
        <br><br>
        <?php
        $recupArticle = $bdb->query('SELECT * FROM produit WHERE catégorie = "Femme"');
        while ($article = $recupArticle->fetch()){
            ?>
            <div class="produit" style="border: 1px solid black;">
                <h3><?= $article['nom'];?></h3>
                <p><?= $article['description'];?></p>
                <img src="<?= $article['image'];?>">
                <h3><?= $article['prix']; ?>$</h3>
                <h3><?= $article['catégorie'] ?></h3>
                <a href="Panier/Ajoutpanier.php?id=<?= $article['id'];?>">
                    <button> Ajouter au panier </button>
                </a>
            </div>
            <?php
        } ?>
    </div>
</div>
<!--Fin contenu-->

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
