<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
$recupUser = $bdb->prepare('SELECT * FROM admin WHERE nom = ? AND pass = ?');
$recupUser->execute(array($_SESSION['nom'], $_SESSION['pass']));
if (!($recupUser->rowCount() > 0)){
    header('Location: LoginAdmin.php');

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
                <a href="../Accueil.html">Acceuil </a>
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
        <!--contenu-->
        <div class="containerZone">
          <div class="regform">
            <h1> Afficher tous les utilisateurs</h1><br><br>
            <?php
             $recupUser = $bdb->query('SELECT * FROM client');
             while ($user = $recupUser->fetch()){
                 ?>
                  <div class="client" style="border: 1px solid black;">

                  <p><?= $user['nom']; ?></p>


                  <a href="bannir.php?id=<?= $user['id'];?>">
                      <button> Bannir le memebre </button>
                  </a>
                 </div>
                 
                 <?php
             }
             ?>
                 
         
             </div>
             </div>
       
     
             
             }
               
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