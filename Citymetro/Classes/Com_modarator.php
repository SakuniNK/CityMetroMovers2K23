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
 * Description of Com_modarator
 *
 * @author Chalitha
 */
class Com_modarator {
    //put your code here
    
    private $count;
    private $station_user;
    private $pkg_user;
     private $earnings =0;
    


    public function today_Tickets() {
          $dbcon =new DBConnector();
          $con = $dbcon->getConnection();
          
            $date=date('Y-m-d'); 
            
            try{
              $query2 ="SELECT COUNT(*) as count FROM station_user WHERE Issue_date=?";
              $pstmt =$con->prepare($query2);
              $pstmt ->bindValue(1,$date);
              $pstmt->execute();
              
              $rs2 =$pstmt->fetch(PDO::FETCH_ASSOC);
              $countAll = $rs2["count"];
              $this->count =$countAll;
              
              
           }
           
           catch (PDOException $exc){
                echo $exc->getMessage();
             }
             
             
             return $this->count;
        
    }

    function station_user(){
        
        
        
          $dbcon =new DBConnector();
          $con = $dbcon->getConnection();
          
           try{
              $date=date('Y-m-d'); 
              $query ="SELECT COUNT(*) as count FROM station_user WHERE Issue_date=? AND pkg_id ='-N/A-'";
              $pstmt =$con->prepare($query);
              $pstmt ->bindValue(1,$date);
              $pstmt->execute();
              
              $rs1 =$pstmt->fetch(PDO::FETCH_ASSOC);
              $count_station = $rs1["count"];
              $this->station_user =$count_station;
              
              
           }
           
           catch (PDOException $exc){
                echo $exc->getMessage();
             }
             
          return $this->station_user;  
        
    }
        
    function pkg_user(){
        
        $this->pkg_user = $this->count-$this->station_user;
        
             
          return $this->pkg_user;  
        
    }
        
 

    function getEarnings() {
         $dbcon =new DBConnector();
          $con = $dbcon->getConnection();
          
           try{
              $date=date('Y-m-d'); 
              $query ="SELECT SUM(price) AS sum FROM station_user WHERE Issue_date=?";
              $pstmt =$con->prepare($query);
              $pstmt ->bindValue(1,$date);
              $pstmt->execute();
              
              $rs1 =$pstmt->fetch(PDO::FETCH_ASSOC);
              $this->earnings= $rs1['sum'];
              
             
              
              }
           
           catch (PDOException $exc){
                echo $exc->getMessage();
             }
             
          
        return $this->earnings;
    }
    
    function pdfgenerate($month) {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $pdfquery = "SELECT * FROM station_user WHERE Month(Issue_date)=$month";
        $pstmt = $con->prepare($pdfquery);
        $pstmt->execute();
        $pdfArray=array();
    //    $query_run = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        while($row = $pstmt->fetch(PDO::FETCH_ASSOC)){
            if($row['price'] > 0){ 
            $id = $row['user_id'];
        $pdfquery1 = "SELECT user_nic FROM user WHERE user_id =?";
        $pstmt1 = $con->prepare($pdfquery1);
        $pstmt1->bindValue(1,$id);
        $pstmt1->execute();
        $rs= $pstmt1->fetch(PDO::FETCH_ASSOC);
        $user_nic = $rs['user_nic'];
            
            
            $pdfArray[] = array(
                $user_nic,
                $row['Start_station'],
                $row['Destination'],
                $row['price'],
                
            );
            }
        }

        return $pdfArray;
    }
}
