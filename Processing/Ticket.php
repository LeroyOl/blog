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
        $billetTotalReq = $prepare->query('SELECT id FROM billets');
        $billetsParPage = 2;
        $billetTotal = $billetTotalReq->rowCount();
        $pagesTotal = ceil($billetTotal / $billetsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        $depart = ($pageCourante - 1) * $billetsParPage;
        $req = $prepare->query('SELECT id,titre,content, DATE_FORMAT(datePost, \'%d/%m/%Y à %Hh%i\') AS datePost_fr FROM billets ORDER BY ID LIMIT ' . $depart . ',' . $billetsParPage);
        return $req;
    }
    public function getComments()
    {
        $prepare = $this->connect();
        $comsParPage = 5;
        $comsTotalReq = $prepare->prepare('SELECT id FROM commentaires WHERE id_billet=?');
        $comsTotalReq->execute(array($_GET['billet']));
        $comsTotal = $comsTotalReq->rowcount();
        $pagesTotal = ceil($comsTotal / $comsParPage);

        if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotal) {
            $_GET['page'] = intval($_GET['page']);
            $pageCourante = $_GET['page'];
        } else {
            $pageCourante = 1;
        }

        $depart = ($pageCourante - 1) * $comsParPage;
        $req = $prepare->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%i\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire DESC LIMIT ' . $depart . ',' . $comsParPage);
        $req->execute(array($_GET['billet']));
        return $req;
    }

    public function pagin()
    {
        $prepare = $this->connect();
        $billetTotalReq = $prepare->query('SELECT id FROM billets');
        $billetsParPage = 2;
        $billetTotal = $billetTotalReq->rowCount();
        $pagesTotal = ceil($billetTotal / $billetsParPage);

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
                echo '<a href=/blog/Pages/index.php?page=' . $i . '">' . $i . '</a> ';
            }
        }
    }
    public function paginComments()
    {
        $prepare = $this->connect();
        $comsParPage = 5;
        $comsTotalReq = $prepare->prepare('SELECT id FROM commentaires WHERE id_billet=?');
        $comsTotalReq->execute(array($_GET['billet']));
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
                echo '<a href="comments.php?billet=' . $_GET['billet'] . '&page=' . $i . '">' . $i . '</a> ';
            }
        }
    }
}
