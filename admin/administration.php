<?php
try{
    $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8','root','');
}                   
catch(Exception $e){
    die('Erreur '. $e->getMessage());
}

// Ajouter un billet
if(isset($_POST['titreAdd'],$_POST['contentAdd'])){
$req = $bdd->prepare('INSERT INTO billets (titre,content) VALUES(?,?)');
$req->execute(array($_POST['titreAdd'],$_POST['contentAdd']));

header('Location: admin.php');
exit();
}
// Modifier un billet
if(isset($_POST['titreFindMod'])){
$req = $bdd->prepare('UPDATE billets SET titre=?,content=? WHERE titre=? ');

if(isset($_POST['titreMod'],$_POST['contentMod'],$_POST['titreFindMod'])){
  $req->execute(array($_POST['titreMod'],$_POST['contentMod'],$_POST['titreFindMod']));
  }
header('Location: admin.php');
exit();
}
// Supprimer un billet
if(isset($_POST['titreSup'])){
$req = $bdd->prepare('DELETE FROM billets WHERE titre=? LIMIT 1');
$req->execute(array($_POST['titreSup']));
header('Location: admin.php');
exit();
}