<?php
session_start();
$bdb = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'root');
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid =$_GET['id'];
    $recupArticle =$bdb->prepare('SELECT * FROM produit WHERE id= ?');
    $recupArticle->execute(array($getid));
    if($recupArticle->rowCount() > 0){
        $deleteArticle = $bdb->prepare('DELETE FROM produit WHERE id= ?');
        $deleteArticle->execute(array($getid));
        header('Location: Article.php');
    }else{
        echo "Aucun article trouvé";
    }
}else{
    echo "Aucun identifiant trouvé";
}
?>
          
                
