<?php
require('../controller/Database.php');

class model extends Database
{

    public function __construct()
    {
    }
    public function getPost()
    {
        $prepare = $this->connect();
        $postTotalReq = $prepare->query('SELECT id FROM post');
        $postsParPage = 2;
        $postTotal = $postTotalReq->rowCount();
        $pagesTotal = ceil($postTotal / $postsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        $depart = ($pageCourante - 1) * $postsParPage;
        $req = $prepare->query('SELECT id,title,content, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%i\') AS datePost_fr FROM post ORDER BY ID LIMIT ' . $depart . ',' . $postsParPage);
        return $req;
    }

    public function PostShow($postId)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT id,title,content, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%i\') AS datePost_fr FROM post WHERE id=?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function getComments($postId)
    {
        $bdd = $this->connect();
        $comsParPage = 5;
        $comsTotalReq = $bdd->prepare('SELECT id FROM comments WHERE id_post=?');
        $comsTotalReq->execute(array($postId));
        $comsTotal = $comsTotalReq->rowcount();
        $pagesTotal = ceil($comsTotal / $comsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        $depart = ($pageCourante - 1) * $comsParPage;
        $comments = $bdd->prepare('SELECT author, comment, DATE_FORMAT(date_comments, \'%d/%m/%Y à %Hh%i\') AS date_comments_fr FROM comments WHERE id_post = ? ORDER BY date_comments DESC LIMIT ' . $depart . ',' . $comsParPage);
        $comments->execute(array($postId));

        return $comments;
    }

    public function pagin()
    {
        $bdd = $this->connect();
        $postTotalReq = $bdd->query('SELECT id FROM post');
        $postsParPage = 2;
        $postTotal = $postTotalReq->rowCount();
        $pagesTotal = ceil($postTotal / $postsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        for ($i = 1; $i <= $pagesTotal; $i++) {
            if ($i == $pageCourante) {
                echo $i . ' ';
            } else {
                echo '<a href=/blog/view/index.php?page=' . $i . '>' . $i . '</a> ';
            }
        }
    }
    public function paginComments($postId)
    {
        $bdd = $this->connect();
        $comsParPage = 5;
        $comsTotalReq = $bdd->prepare('SELECT id FROM comments WHERE id_post=?');
        $comsTotalReq->execute(array($postId));
        $comsTotal = $comsTotalReq->rowcount();
        $pagesTotal = ceil($comsTotal / $comsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        for ($i = 1; $i <= $pagesTotal; $i++) {
            if ($i == $pageCourante) {
                echo $i . ' ';
            } else {
                echo '<a href="index.php?action=post&amp;id=' . $postId . '&page=' . $i . '&#titre">' . $i . '</a> ';
            }
        }
    }

    public function postComment($postId, $author, $comment)
    {   
        $db = $this->Connect();
        $comments = $db->prepare('INSERT INTO comments(id_post, author, comment, date_comments) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
    
        return $affectedLines;
    }
}