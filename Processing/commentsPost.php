<?php
session_start();
require ('Database.php');
$bdd = new database;
$bdd = $bdd->connect();
$req = $bdd->prepare('INSERT INTO comments (id_post,author,comment) VALUES(?,?,?)');
$req->execute(array($_POST['id'],$_POST['nom'],$_POST['com']));

header('Location: ../Pages/comments.php?post=' . htmlspecialchars($_POST['id']));
exit();
?>