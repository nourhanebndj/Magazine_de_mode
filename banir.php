<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre;charset=utf8', 'root', '');
if(isset($_GET['id'])AND !empty($_GET['id'])){
    $getid=$_GET['id'];
    $recupUser=$bdd->prepare('SELECT*FROM utilisateur WHERE id=?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount()>0){
        $baniruser=$bdd->prepare('DELETE FROM utilisateur WHERE id=?');
        $baniruser->execute(array($getid));
        header('location:membre.php');
    }else{
        echo"aucun membre n'a ete trouve";
    }
}else{
    echo "l'identifiant n'a pas ete recupere ";
}
?>