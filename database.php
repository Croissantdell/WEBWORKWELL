<?php

class Database {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'projetphp';
        $username = 'root';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$dbname";
        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function getPDO() {
        return $this->pdo;
    }
}
