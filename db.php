<?php
try{
    $db=new PDO('mysql:host=localhost;dbname=espace_membre','root','');
}
catch(PDOException $e){
    print"erreur:".$e->getMessage()."</br>";
}
?>