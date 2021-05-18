<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid =$_GET['id'];
$recupArticle =$bdb->prepare('SELECT * FROM produit WHERE id= ?');
$recupArticle->execute(array($getid));
if($recupArticle->rowCount()> 0){
        $articleInfos = $recupArticle->fetch();
        $nom = $articleInfos['nom'];
        $description = $articleInfos ['description'];
        $image = $articleInfos ['image'];
        $prix = $articleInfos ['prix'];
        $categorie = $articleInfos ['catégorie'];

      
        if (isset($_POST['Envoyer'])){
            $nom_saisi=htmlspecialchars($_POST['nom']);
            $description_saisi=htmlspecialchars($_POST['description']);
            $image_saisi=htmlspecialchars($_POST['image']);
            $prix_saisi=htmlspecialchars($_POST['prix']);
            $categorie_saisi=htmlspecialchars($_POST['categorie']);
            $updateArticle = $bdb->prepare('UPDATE produit SET nom= ? , description= ?, image= ?, prix= ?, catégorie= ? WHERE id= ?');
            $updateArticle->execute(array( $nom_saisi,$description_saisi,$image_saisi,$prix_saisi,$categorie_saisi ,$getid));
            header('Location: Article.php');
        }
    }else{
                echo "Aucun article trouvé";
    }
}else{
            echo "Aucun identifiant trouvé";
        
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
        <h1> Modifier les articles  </h1> <br><br>
        <div class="formulaire">
        <form action="" method="post">
                <h3>Produit :</h3><input type="text" name="nom" value= "<?= $nom; ?> ">
                <h3>Description :</h3><textarea  name="description"><?= $description; ?></textarea>
                <h3>image :</h3><textarea  name="image"><?= $image; ?> </textarea>
                <h3>prix :</h3><textarea  name="prix"><?= $prix; ?> </textarea> 
                <h3>Catégorie :</h3><textarea name="categorie" ><?= $categorie; ?></textarea><br></br>
                <input type="submit" name="Envoyer"  >
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
          
                
