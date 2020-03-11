<?php

class Database
{

    private $dbname = 'blog';
    private $dbuser = 'root';
    private $dbhost = 'localhost:3306';
    private $dbpassword = '';

    public function __construct()
    {
    }

    protected function connect()
    {
        try {
            $bdd = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", "$this->dbuser", "$this->dbpassword");
            return $bdd;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
}
