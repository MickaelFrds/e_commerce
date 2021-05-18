<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid =$_GET['id'];
    $recupUser =$bdb->prepare('SELECT * FROM client WHERE id= ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        $deleteUser = $bdb->prepare('DELETE FROM client WHERE id= ?');
        $deleteUser->execute(array($getid));
        header('Location: Utilisateurs.php');
    }else{
        echo "Aucun membre trouvé";
    }
}else{
    echo "Aucun identifiant récupéré";
}
?>