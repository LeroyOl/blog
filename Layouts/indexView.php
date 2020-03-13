
<?php ob_start(); ?>


  <?php foreach ($data as $var) : ?>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0"><?= $var['title'] ?></h3>
          <div class="mb-1 text-muted"><?= $var['datePost_fr'] ?></div>
          <p class="card-text mb-auto"><?= $var['content'] ?></p>
          <em><a href="comments.php?post=<?= $var['id'] ?>">Commentaires</a></em>
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
    $pagin = new Post();
    $pagin->pagin();
    ?>
  </div>
  <?php $content = ob_get_clean(); ?>
  <?php require('template.php'); ?>