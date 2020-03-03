<?php
session_start();
//Connexion à la base de donnée
try {
  $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Erreur: ' . $e->getMessage());
}
$billet = $bdd->query('SELECT id,titre,content, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%i\') AS datePost_fr FROM billets ORDER BY ID ');
$donnees = $billet->fetchAll();

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>admin</title>
</head>

<body>
  <div class="row p-5 border">
    <div class="col-md-12 text-center ">
      <h1>Interface d'administration</h1>
    </div>
  </div>
  <div class="row m-5 ">
    <form class="col-md-4" action="administration.php" method="post">
      <h1 class="text-primary h2 mb-5 text-center  ">Ajouter un billet</h1>
      <label for="titreAdd">Ajouter un titre</label>
      <input type="text" class="form-control" name="titreAdd" id="titreAdd" required>
      <label for="contentAdd" id="contentAdd" name="contentAdd">Contenu du billet</label>
      <textarea class="form-control" type="text" name="contentAdd" id="contentAdd" rows="10"></textarea>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter</button>
    </form>
    <form class="col-md-4" action="administration.php" method="post">
      <h1 class="text-success h2 mb-5 text-center ">Modifier un billet</h1>
      <label for="titreFindMod"> Entrez le titre du billet à modifier</label>
      <input type="text" class="form-control" name="titreFindMod" id="titreFindMod" required>
      <label for="titreMod">Modifier le titre du billet </label>
      <input type="text" class="form-control" name="titreMod" id="titreMod" required>
      <label for="contenu" id="contentMod" name="contentMod">Modifier son contenu</label>
      <textarea class="form-control" type="text" name="contentMod" id="contentMod" required rows="7"></textarea>
      <button class="btn btn-lg btn-success btn-block" type="submit">Modifier</button>
    </form>
    <form class="col-md-4" action="administration.php" method="post">
      <h1 class="text-danger h2 mb-5 text-center ">Supprimer un billet</h1>
      <label for="titreSup">Entrez le titre du billet à supprimer</label>
      <input type="text" class="text-danger form-control" name="titreSup" id="titreSup" placeholder="Attention, ceci détruit le billet définitivement!" required>
      <button class="btn btn-lg btn-danger btn-block" type="submit">Supprimer</button>
      <div class="listbillet border m-5 text-center">
        <h2>Billet sur le site : </h2>
        <?php foreach ($donnees as $var) : ?>
          <p><?= $var['titre'] ?></p>
        <?php endforeach ?>
      </div>
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>