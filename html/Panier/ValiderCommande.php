<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupUser = $bdb->prepare('SELECT * FROM client WHERE nom = ? AND pass = ?');
$recupUser->execute(array($_SESSION['nom'], $_SESSION['pass']));
if (!($recupUser->rowCount() > 0)){
    header('Location:../Client/Loginclient.php');
}
if (isset($_POST['Valider'])){
    if(empty($_POST['Card_Num']) || empty($_POST['Card_Cvv']) || empty($_POST['Card_Date'])  || empty($_POST['Card_Name'])){
        echo "Veuillez completer les champs";
    }else {
        $Card_Num = $_POST['Card_Num'];
        $Card_Cvv = $_POST['Card_Cvv'];
        $Card_Date = $_POST['Card_Date'];
        $Card_Name = $_POST['Card_Name'];
        $UpdateCard = $bdb->prepare('UPDATE client SET Card_Num=?, Card_Cvv=?, Card_Date=?, Card_Name=? WHERE id=?');
        $UpdateCard->execute(array($Card_Num,$Card_Cvv,$Card_Date,$Card_Name,$_SESSION['id']));
        header('Location: EspaceClient.php');
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
        <a href="../Admin/EspaceAdmin.php" class="fas fa-user-lock"></a>
        <a href="../Panier/panier.php" class="fas fa-shopping-cart"></a>
        <a href="../Client/EspaceClient.php" class="fas fa-user-circle"></a>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
<!--Header-->
<header>
</header>
<!-- Fin Header-->
<div class="Panier">
    <h1>Payement</h1>
    <h3>Payer avec la carte enregistrer sur mon compte</h3>
    <div class="carte">
        <table class="Panier">
        <?php
        while ($user = $recupUser->fetch()){?>
            <tr>
                <td><?php echo $user['Card_Num'];?></td>
                <td><?php echo $user['Card_Cvv'];?></td>
                <td><?php echo $user['Card_Date'];?></td>
                <td><?php echo $user['Card_Name'];?></td>
                <td class="BoutonPanier"><a class="Valider" href="SuccesCommande.php"><button name="Valider">Valider</button></a></td>
            </tr>
        <?php }?>
        </table>
    </div>
        <br><br>
    <h3>Enregistrer un carte </h3>
    <div class="formulaire">
            <form method="POST" action="">
                <label class="Card_Num"> Numero de carte :</label>
                <input class="input" type="text" name="Card_Num"><br><br>
                <label class="Card_Cvv">Cvv : </label>
                <input class="input" type="text" name="Card_Cvv"><br><br>
                <label class="Card_Date">Date d'expiration de la carte : </label>
                <input class="input" type="text" name="Card_Date"><br><br>
                <label class="Card_Name">Nom du propriétaire de la carte : </label>
                <input class="input" type="text" name="Card_Name"><br><br>
                <td class="BoutonPanier"><a class="Valider" href="SuccesCommande.php"><button name="Valider">Valider</button></a></td>
            </form>
    </div>
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