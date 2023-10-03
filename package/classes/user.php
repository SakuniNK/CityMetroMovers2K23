<?php

namespace classes;

use PDO;
use PDOException;

require 'DbConnector.php';

class user {
   
     private $User_id;
     private $User_fname;
     private $User_lname;
     private $User_email;
     
//     public function __construct($User_id, $User_fname, $User_lname, $User_email) {
//         $this->User_id = $User_id;
//         $this->User_fname = $User_fname;
//         $this->User_lname = $User_lname;
//         $this->User_email = $User_email;
//     }

    public function pkgconfirmUser(){
        
        $dbcon1 = new DbConnector();
        $con1 = $dbcon1->getConnection();
        
        $query = "SELECT * FROM user WHERE user_id='$userID'";
        try {
            $pstmt = $con1->prepare($query);
            $pstmt->execute();
            $result = $pstmt->fetchALl(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            die("Connection Failed.".$ex->getMessage());
        }
         
    }
    
    
}
