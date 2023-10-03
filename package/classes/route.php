<?php

namespace classes;

use PDO;
use PDOException;

require 'DbConnector.php';

class route {
   
    private $Route_id;
    private $Route_start;
    private $Route_end;
    private $Route_no;
    
//    public function __construct($Route_id, $Route_start, $Route_end, $Route_no) {
//        $this->Route_id = $Route_id;
//        $this->Route_start = $Route_start;
//        $this->Route_end = $Route_end;
//        $this->Route_no = $Route_no;
//    }

    
    public function displayRoute(){
        $dbcon2 = new DbConnector();
        $con2 = $dbcon2->getConnection();
        
        $query = "SELECT * FROM route";
        
        try {
            $pstmt = $con2->prepare($query);
            $pstmt->execute();
            $result = $pstmt->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            die("Connection failed.".$ex->getMessage());
        }
    }
}
