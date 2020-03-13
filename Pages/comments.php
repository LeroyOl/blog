<?php
session_start();
require_once('../Processing/Ticket.php');
$tickets = new Ticket();
$data = $tickets->TicketShow()->fetchAll();
require "../Layouts/base.php";

  if (!empty($data)) {
    foreach ($data as $var) : ?>
      <div class="col-md-12" id="titre">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?= htmlspecialchars($var["title"]) ?></strong>
            <div class="mb-1 text-muted"><?= $var["datePost_fr"] ?> </div>
            <p class="card-text mb-auto"><a href="index.php">Retour à la liste des posts</a></p>
            <h2> Commentaire </h2>
        <?php endforeach;
    } else {
      var_dump($_GET['post']);
      echo "La page n'existe pas";
    }
        ?>
        <?php
        $comment = new Ticket();
        $comments = $comment->getComments();
        // Récupération des commentaires

        while ($donnees = $comments->fetch()) {
          echo '<p ><strong>' . htmlspecialchars($donnees['author']) . '</strong> le ' . $donnees['date_comments_fr'] . '</p>
        <p>' .  nl2br(htmlspecialchars($donnees['comment'])) . '</p>';
        } // Fin de la boucle des commentaires
        $comments->closeCursor();
        ?>
          </div>
          <div class="col-auto d-none d-lg-block">
            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12 text-center">
            <?php
            $pagin = new ticket();
            $pagin->paginComments();
            ?>
          </div>
        </div>

        <form class="col-md-12" action="../Processing/commentsPost.php" method="post">
          <h1 class="h3 mb-3 font-weight-normal">Votre commentaire</h1>
          <label for="nom" class="sr-only">Nom</label>
          <input type="text" name="nom" class="form-control" id="nom" value="" placeholder="Entrez votre nom (requis)" required>
          <input type=hidden name=id value="<?= $_GET['post']; ?>">
          <textarea name="com" class="form-control" id="com" required rows="5"></textarea>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
        </form>
      </div>
      <?php require ('../Layouts/Parts/footer.php');?>