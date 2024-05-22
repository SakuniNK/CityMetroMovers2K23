<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;
require './Classes/DBConnector.php';
use Classes\DBConnector;
use PDOException;
use PDO;
/**
 * Description of Station_Master
 *
 * @author Chalitha
 */
class Station_Master {
    
    private $iteraries;
    private $earnings =0;
    



   function getIteraries($station_A) {
        
        
       
          $dbcon =new DBConnector();
          $con = $dbcon->getConnection();
          $station =$station_A;
           try{
              $date=date('Y-m-d'); 
              $query2 ="SELECT COUNT(*) as count FROM station_user WHERE Issue_date=? AND Start_station=?";
              $pstmt =$con->prepare($query2);
              $pstmt ->bindValue(1,$date);
              $pstmt ->bindValue(2,$station);
              $pstmt->execute();
              
              $rs2 =$pstmt->fetch(PDO::FETCH_ASSOC);
              $count = $rs2["count"];
              $this->iteraries =$count;
              
              
           }
           
           catch (PDOException $exc){
                echo $exc->getMessage();
             }
             
          return $this->iteraries;  
        
    }
        
 

    function getEarnings($station_A) {
         $dbcon =new DBConnector();
          $con = $dbcon->getConnection();
           $station =$station_A;
          
          
           try{
              $date=date('Y-m-d'); 
              $query_3 ="SELECT SUM(price) AS sum FROM station_user WHERE Issue_date=? AND Start_station=?" ;
              $pstmt =$con->prepare($query_3);
              $pstmt ->bindValue(1,$date);
              $pstmt ->bindValue(2,$station);
              $pstmt->execute();
              
              $rs3=$pstmt->fetch(PDO::FETCH_ASSOC);
              $this->earnings= $rs3["sum"];
              
              
             
              
              }
           
           catch (PDOException $exc){
                echo $exc->getMessage();
             }
             
          
        return $this->earnings;
    }
    
}

