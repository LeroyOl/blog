<?php
session_start();

//connexion a la Bdd
try {
    $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
  }

//Insertion du nom et message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaires (id_billet,auteur,commentaire) VALUES(?,?,?)');
$req->execute(array($_POST['id'],$_POST['nom'],$_POST['com']));

// Redirection du visiteur vers la page commentaire.php
header('Location: ../Pages/commentaires.php?billet=' . htmlspecialchars($_POST['id']));
exit();
?>