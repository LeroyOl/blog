<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
      <div class="col-md-12" id="titre">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?= htmlspecialchars($post["title"]) ?></strong>
            <div class="mb-1 text-muted"><?= $post["datePost_fr"] ?> </div>
            <p class="card-text mb-auto"><a href="index.php">Retour à la liste des posts</a></p>
            <h2> Commentaire </h2>
        <?php
        while ($comment = $comments->fetch()) {
          echo '<p ><strong>' . htmlspecialchars($comment['author']) . '</strong> le ' . $comment['date_comments_fr'] . '</p>
        <p>' .  nl2br(htmlspecialchars($comment['comment'])) . '</p>';
        } 
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
            $pagin = new model();
            $pagin->paginComments($_GET['id']);
            ?>
          </div>
        </div>

        <form class="col-md-12" action="../controller/backend.php" method="post">
          <h1 class="h3 mb-3 font-weight-normal">Votre commentaire</h1>
          <label for="nom" class="sr-only">Nom</label>
          <input type="text" name="nom" class="form-control" id="nom" value="" placeholder="Entrez votre nom (requis)" required>
          <input type=hidden name=id value="<?= $_GET['id']; ?>">
          <textarea name="com" class="form-control" id="com" required rows="5"></textarea>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Envoyer</button>
        </form>
      </div>
    <?php $content = ob_get_clean(); ?>
    <?php require('template.php'); ?>