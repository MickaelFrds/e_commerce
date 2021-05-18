<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupUser = $bdb->prepare('SELECT * FROM client WHERE nom = ? AND pass = ?');
$recupUser->execute(array($_SESSION['nom'], $_SESSION['pass']));
if (!($recupUser->rowCount() > 0)){
    header('Location:Loginclient.php');
}
if (isset($_POST['deconnexion'])){
    $_SESSION = array();
    session_destroy();
    header('Location:LoginClient.php');
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
        <a href="../Admin/EspaceAdmin.php" class="fas fa-user-lock"></a>
        <a href="../Panier/panier.php" class="fas fa-shopping-cart"></a>
        <a href="EspaceClient.php" class="fas fa-user-circle"></a>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
<!--Header-->
<header>
    <?php
    echo $_SESSION['nom'];
    ?>
</header>
<!-- Fin Header-->
<!-- Contenu -->
    <div class="panel">
        <a class="Modifier" href="Modifier.php"><button name="modifier">Modifier</button></a>
        <form method="post"><button name="deconnexion">Deconnexion</button></form>
    </div>
    <div class="tableau">
        <?php $user= $recupUser->fetch();?>
        <table>
            <tr>
                <td>Nom :</td>
                <td><?php echo $user['nom'];?></td>
            </tr>
            <tr>
                <td>Numero de carte :</td>
                <td><?php echo $user['Card_Num'];?></td>
                </tr>
            <tr>
                <td>Cvv :</td>
                <td><?php echo $user['Card_Cvv'];?></td>
            </tr>
            <tr>
                <td>Date d'expiration de la carte :</td>
                <td><?php echo $user['Card_Date'];?></td>
            </tr>
            <tr>
                <td>Nom du propriétaire de la carte :</td>
                <td><?php echo $user['Card_Name'];?></td>
            </tr>
        </table>
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

