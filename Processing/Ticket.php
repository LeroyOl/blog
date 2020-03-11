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
}


