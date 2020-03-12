<?php
require('Database.php');

class ticket extends Database
{
    
    public function __construct()
    {
    }
    public function getTicket()
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
    public function TicketShow()
    {
        $prepare = $this->connect();
        $req = $prepare->prepare('SELECT id,title,content, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%i\') AS datePost_fr FROM post WHERE id=?');
        $req->execute(array($_GET['post']));
        return $req;
    }
    public function getComments()
    {
        $prepare = $this->connect();
        $comsParPage = 5;
        $comsTotalReq = $prepare->prepare('SELECT id FROM comments WHERE id_post=?');
        $comsTotalReq->execute(array($_GET['post']));
        $comsTotal = $comsTotalReq->rowcount();
        $pagesTotal = ceil($comsTotal / $comsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        $depart = ($pageCourante - 1) * $comsParPage;
        $req = $prepare->prepare('SELECT author, comment, DATE_FORMAT(date_comments, \'%d/%m/%Y à %Hh%i\') AS date_comments_fr FROM comments WHERE id_post = ? ORDER BY date_comments DESC LIMIT ' . $depart . ',' . $comsParPage);
        $req->execute(array($_GET['post']));
        return $req;
    }

    public function pagin()
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

        for ($i = 1; $i <= $pagesTotal; $i++) {
            if ($i == $pageCourante) {
                echo $i . ' ';
            } else {
                echo '<a href=/blog/Pages/index.php?page=' . $i . '>' . $i . '</a> ';
            }
        }
    }
    public function paginComments()
    {
        $prepare = $this->connect();
        $comsParPage = 5;
        $comsTotalReq = $prepare->prepare('SELECT id FROM comments WHERE id_post=?');
        $comsTotalReq->execute(array($_GET['post']));
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
                echo '<a href="comments.php?post=' . $_GET['post'] . '&page=' . $i . '">' . $i . '</a> ';
            }
        }
    }
}
