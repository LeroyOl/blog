<?php
session_start();

//connexion a la Bdd
try {
    $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
  }
if(isset($_POST['nom'])){
    $_SESSION['nom'] = $this;
}
//Insertion du nom et message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaire (id_billet,auteur,commentaire) VALUES(?,?,?');
$req->execute(array($_GET['billet'],$_POST['nom'],$_POST['com']));

// Redirection du visiteur vers la page commentaire.php
header('Location: commentaires.php?billet=' . $_GET['billet']);
?>