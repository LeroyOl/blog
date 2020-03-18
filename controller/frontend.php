<?php
require('../model/frontend.php');

function listPosts()
{
    $post = new model;
    $posts = $post->getPost();

    require('../view/frontend/listPostsView.php');
}

function post()
{
    $post = new model;
    $post = $post->PostShow($_GET['id']);

    $comment = new model;
    $comments = $comment->getComments($_GET['id']);

    require('../view/frontend/PostView.php');
}

function addComment($postId, $author, $comment)
{
    $affectedLines = new model;
    $affectedLines->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        die('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
