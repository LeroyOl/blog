<?php
try{
    $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8','root','');
}                   
catch(Exception $e){
    die('Erreur '. $e->getMessage());
}

// add billet
if(isset($_POST['titreAdd'],$_POST['contentAdd'])){
$req = $bdd->prepare('INSERT INTO post (title,content) VALUES(?,?)');
$req->execute(array($_POST['titreAdd'],$_POST['contentAdd']));

header('Location: interfaceAdmin.php');
exit();
}
// Modifier un billet
if(isset($_POST['titreFindMod'])){
$req = $bdd->prepare('UPDATE post SET title=?,content=? WHERE title=? ');

if(isset($_POST['titreMod'],$_POST['contentMod'],$_POST['titreFindMod'])){
  $req->execute(array($_POST['titreMod'],$_POST['contentMod'],$_POST['titreFindMod']));
  }
header('Location: interfaceAdmin.php');
exit();
}
// delette billet
if(isset($_POST['titreSup'])){
$req = $bdd->prepare('DELETE FROM post WHERE title=? LIMIT 1');
$req->execute(array($_POST['titreSup']));
header('Location: interfaceAdmin.php');
exit();
}