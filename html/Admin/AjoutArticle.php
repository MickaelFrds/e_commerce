<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupUser = $bdb->prepare('SELECT * FROM admin WHERE nom = ? AND pass = ?');
$recupUser->execute(array($_SESSION['nom'], $_SESSION['pass']));
if (!($recupUser->rowCount() > 0)){
    header('Location:LoginAdmin.php');
}
if(isset($_POST['Confirmer'])){
    if(!(empty($_POST['nom'])) || !empty($_POST['description']) || !empty($_POST['image']) || !empty($_POST['prix']) || !empty($_POST['catégorie'])){
        $nom=htmlspecialchars($_POST['nom']);
        $description=htmlspecialchars($_POST['description']);
        $image=htmlspecialchars($_POST['image']);
        $prix=htmlspecialchars($_POST['prix']);
        $categorie=htmlspecialchars($_POST['catégorie']);
        $insererArticle = $bdb->prepare('INSERT INTO produit (id,nom,description,image,prix,catégorie) VALUES (NULL,?,?,?,?,?)');
        $insererArticle->execute(array($nom,$description,$image,$prix,$categorie));
        echo "L'article a bien été envoyé";
}else{
    echo "Veuillez completer tous les champs";
}
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
        <a href="EspaceAdmin.php" class="fas fa-user-lock"></a>
        <a href="../Panier/panier.php" class="fas fa-shopping-cart"></a>
        <a href="../Client/EspaceClient.php" class="fas fa-user-circle"></a>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
<!--Header-->
<header>
</header>
<!-- Fin Header-->
<!-- Contenu -->
<div class="containerZone">
    <div class="regform">
        <h1> Ajouter un article</h1><br><br>
        <div class="formulaire">
        <form action="" method="post">
                <h3>Produit :</h3><input type="text" name="nom"/>
                <h3>Description :</h3><input type="text" name="description"/>
                <h3>image :</h3><input type="text" name="image"/>
                <h3>prix :</h3><input type="text" name="prix"/>
                <h3>Catégorie :</h3><input type="text" name="catégorie"/><br></br>
                <input type="submit" name="Confirmer"/>
        </form>
        </div>
    </div>
</div>
<!-- Fin Contenu -->
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



