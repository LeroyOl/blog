<?php
session_start();
include_once "../Layouts/base.php";
//Connexion à la base de donnée
try {
  $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Erreur: ' . $e->getMessage());
}
$billetsParPage = 2;
$billetTotalReq = $bdd->query('SELECT id FROM billets');
$billetTotal = $billetTotalReq->rowCount();
$pagesTotal = ceil($billetTotal / $billetsParPage);
if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotal){
  $_GET['page'] = intval($_GET['page']);
  $pageCourante = $_GET['page'];
} else {
  $pageCourante = 1;
}
$depart = ($pageCourante - 1) * $billetsParPage;

$billet = $bdd->query('SELECT id,titre,content, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%i\') AS datePost_fr FROM billets ORDER BY ID LIMIT ' . $depart . ',' . $billetsParPage);
$donnees = $billet->fetchAll();

?>

<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>
<div class="row mb-2">
  <?php foreach ($donnees as $var) : ?>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0"><?= $var['titre'] ?></h3>
          <div class="mb-1 text-muted"><?= $var['datePost_fr'] ?></div>
          <p class="card-text mb-auto"><?= $var['content'] ?></p>
          <em><a href="commentaires.php?billet=<?= $var['id'] ?>">Commentaires</a></em>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
          </svg>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>
<div class="row mb-2">
<div class="col-md-12 text-center">
<?php

  for($i=1;$i<=$pagesTotal;$i++){
    if($i == $pageCourante){
      echo $i.' ';
    }else{
      echo '<a href="index.php?page='.$i.'">'.$i.'</a> ';
    }
  }
  ?> <?php //test!!
    $billetParPage = function (){
    for($i=1;$i<=$billetTotal;$i++){
    $billetsParPage = $i;
  }
  };?>
  <form action="index.php">
    <label for="nbpage">Nombre de billets par page:</label>
    <select name="nbPage" id="nbPage">
    <?php for($i=1;$i<=$billetTotal;$i++){
      echo '<option value="$billetsParPage='. $i.'">'.$i.'</option>';
    }?>
    </select>
  </form>
  
</div>
<footer class="blog-footer">
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
</body>

</html>