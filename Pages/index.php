<?php
session_start();
require_once('../Processing/Ticket.php');
$tickets = new Ticket();
$data = $tickets->getTicket()->fetchAll();
require "../Layouts/base.php";
?>

<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
  <div class="col-md-6 px-0">
    <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
    <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
  </div>
</div>
<div class="row mb-2">

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
    $pagin = new ticket();
    $pagin->pagin();
    ?>
  </div>
  <footer class="blog-footer">
    <p>
      <a href="#">Back to top</a>
    </p>
  </footer>
  </body>

  </html>