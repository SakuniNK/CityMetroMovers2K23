<?php

namespace classes;

use PDO;
use PDOException;

class DbConnector {
    
    private $host = "localhost";
    private $dbname = "citymetromovers";
    private $dbuser = "root";
    private $dbpwd = "";
    private $con;
    
    public function getConnection(){
        $dsn="mysql:host=".$this->host.";dbname=".$this->dbname.";";
        try {
             $this->con =new PDO($dsn, $this->dbuser, $this->dbpwd);
             return $this->con;
        }catch (PDOException $ex) {
            die("Connection failed: " . $ex->getMessage()); 
        }
       
    }
    
}
