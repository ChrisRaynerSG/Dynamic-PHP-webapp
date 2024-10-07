<?php

namespace App\Database;

use PDO;
use PDOException;

class Database{

    private $host;
    private $port;
    private $database;
    private $username;
    private $password;
    private $pdo;

    public function __construct($host, $database, $username, $password, $port){
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }

    public function connect(){
        if($this->pdo === null){
            try{
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";
                $this->pdo = new PDO($dsn, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //change error mode to throw an exception rather than being silent, hopefully this will help catch issues!
            }
            catch(PDOException $ex){
                die("Could not connect to the database: {$this->database}: " . $ex->getMessage());
            }
        }
        return $this->pdo;
    }
}