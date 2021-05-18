<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
if (isset($_POST['SignUp'])) {
    if (!empty($_POST['name']) and !empty($_POST['pass'])) {
        $name = htmlspecialchars($_POST['name']);
        $pass = htmlspecialchars($_POST['pass']);
        $recupUser = $bdb->prepare('SELECT * FROM client WHERE nom = ? AND pass = ?' );
        $recupUser->execute(array($name,$pass));
        if (!($recupUser->rowCount()>0)){
            $insertUser = $bdb->prepare('INSERT INTO client(nom,pass) VALUE (?,?)');
            $insertUser->execute(array($name, $pass));
            $User = $bdb->prepare('SELECT * FROM client WHERE nom = ? AND pass = ?');
            $User->execute(array($name,$pass));
            $_SESSION['nom'] = $name;
            $_SESSION['pass'] = $pass;
            $_SESSION['id'] = $User->fetch()['id'];
            header('Location:EspaceClient.php');
        } else {
            echo "Cet utilisateur existe deja";
        }
    }else{
        echo "Veuillez completer les champs";
    }
}
?>
<!DOCTYPE html>
<html >
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
        <a href="../Admin/EspaceAdmin.php" class="fas fa-user-lock"></a>
        <a href="../Panier/panier.php" class="fas fa-shopping-cart"></a>
        <a href="EspaceClient.php" class="fas fa-user-circle"></a>
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
        <h1> Inscription </h1><br><br>
        <div class="formulaire">
            <form method="post" action="">
                <label class="name"> Identifiant : </label>
                <input class="input" type="text" name="name"><br><br>
                <label class="pass">Nouveau mot de passe : </label>
                <input class="input" type="password" name="pass"><br><br>
                <input type="submit" value="SignUp" name="SignUp">
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