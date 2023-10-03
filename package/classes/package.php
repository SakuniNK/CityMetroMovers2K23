<?php



namespace classes;

use PDO;
use classes\DbConnector;
use PDOException;

require 'DbConnector.php';

class package {
    
    
    private $Package_id;
    private $Package_title;
    private $Package_price;
    private $Package_trips;
    private $Package_remainings;
    
//    public function __construct($Package_id, $Package_title, $Package_price, $Package_trips, $Package_remainings) {
//        $this->Package_id = $Package_id;
//        $this->Package_title = $Package_title;
//        $this->Package_price = $Package_price;
//        $this->Package_trips = $Package_trips;
//        $this->Package_remainings = $Package_remainings;
//    }

    
    public function pkgDisplay() {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT * FROM package";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);

            return $result; 
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    
}
