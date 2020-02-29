<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Blog Template · Bootstrap</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/blog/">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="blog.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#">Subscribe</a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">Large</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="text-muted" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false">
              <title>Search</title>
              <circle cx="10.5" cy="10.5" r="7.5" />
              <path d="M21 21l-5.2-5.2" />
            </svg>
          </a>
          <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="#">World</a>
        <a class="p-2 text-muted" href="#">U.S.</a>
        <a class="p-2 text-muted" href="#">Technology</a>
        <a class="p-2 text-muted" href="#">Design</a>
        <a class="p-2 text-muted" href="#">Culture</a>
        <a class="p-2 text-muted" href="#">Business</a>
        <a class="p-2 text-muted" href="#">Politics</a>
        <a class="p-2 text-muted" href="#">Opinion</a>
        <a class="p-2 text-muted" href="#">Science</a>
        <a class="p-2 text-muted" href="#">Health</a>
        <a class="p-2 text-muted" href="#">Style</a>
        <a class="p-2 text-muted" href="#">Travel</a>
      </nav>
    </div>

    <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
        <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
      </div>
    </div>
    <div class="row mb-2">
      <?php

      //Connexion à la base de donnée
      try {
        $bdd = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8', 'root', '');
      } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
      }

      // Récupération du billet
      $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%imin%ss\') AS datePost_fr FROM billets WHERE id = ?');
      $req->execute(array($_GET['billet']));
      $donnees = $req->fetch(); {
        echo '<div class="col-md-6">
  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
      <strong class="d-inline-block mb-2 text-primary">' . htmlspecialchars($donnees["titre"]) . '</strong>
      <p class="card-text mb-auto"><a href="index.php">Retour à la liste des billets</a></p>
      <h2> Commentaire </h2>';
      }

      // Récupération des commentaires
      $reqcom = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
      $reqcom->execute(array($_GET['billet']));

      while ($donneescom = $reqcom->fetch()) {

        echo '<p><strong>' . htmlspecialchars($donneescom['auteur']) . '</strong> le ' . $donneescom['date_commentaire_fr'] . '</p>
        <p>' .  nl2br(htmlspecialchars($donneescom['commentaire'])) . '</p>';
      } // Fin de la boucle des commentaires
      $req->closeCursor();
      ?>
    </div>
    <div class="col-auto d-none d-lg-block">
      <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
      </svg>
    </div>
  </div>
  
  <form action="commentaires.php?billet=" methode="post"> 
        <h1 class="h3 mb-3 font-weight-normal">Votre commentaire</h1>
        <label for="nom" class="sr-only">Nom</label>
        <input type="text" name="nom" class="form-control" id="nom" value="<?php if(isset($_SESSION['nom'])){ echo $_SESSION['nom']; } ?>" placeholder="Entrez votre nom (requis)" required autofocus>
        <textarea name="com" class="form-control" id="com" required rows="5"></textarea>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
      </form>

  <footer class="blog-footer">
    <p>
      <a href="#">Back to top</a>
    </p>
  </footer>
</body>

</html>