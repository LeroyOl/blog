<?php

class Database
{

    private $dbname = 'blog';
    private $dbuser = 'root';
    private $dbhost = 'localhost:3306';
    private $dbpassword = '';
    private $charset='utf8';
    public function __construct()
    {
    }

    protected function connect()
    {
        try {
            $bdd = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname;charset=$this->charset", "$this->dbuser", "$this->dbpassword");
            return $bdd;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
}
