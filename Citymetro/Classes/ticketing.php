<?php
namespace Classes;
require 'DBConnector.php';
use Classes\DBConnector;
use PDO;

class ticketing {
   public function ticketIssuing($usernic){
        
      $user_NIC = $usernic;
      
      $queryNIC = "SELECT user_id FROM user WHERE user_nic='$user_NIC'";
      $dbcon = new DBConnector();
      $con = $dbcon->getConnection();
      $pstmtNIC = $con->prepare($queryNIC);
      $pstmtNIC->execute();
      $resultUID = $pstmtNIC->fetch(PDO::FETCH_ASSOC);
      
      if($pstmtNIC->rowCount() > 0){
      
      $user_id = $resultUID['user_id'];
      
      $query4 = "SELECT * FROM user WHERE user_id='$user_id' AND user_role='user'";
      $dbcon = new DBConnector();
      $con = $dbcon->getConnection();
      $pstmt10 = $con->prepare($query4);
      $pstmt10->execute();
      $results = $pstmt10->fetchAll(PDO::FETCH_ASSOC);
      
      if($pstmt10->rowCount() > 0){
          
        $querypkg = "SELECT * FROM pkg_user WHERE User_id='$user_id'";
        $pstmt = $con->prepare($querypkg);
        $pstmt->execute();
        $resultpkg = $pstmt->fetchAll(PDO::FETCH_ASSOC);
        
          if($pstmt->rowCount() > 0){
          
          foreach ($resultpkg as $resultpkginsert) {
          $userpkg = $resultpkginsert['Pkg_id'];
          } 
          
         
         
         $query1= "SELECT * FROM station_user WHERE user_id='$user_id' AND pkg_id='$userpkg' ";
           $pstmt1 = $con->prepare($query1);
           $pstmt1->execute();
           $resultremaining1= $pstmt1->fetchAll(PDO::FETCH_ASSOC); 
          
           
           
        if ($pstmt1->rowCount() > 0) {

          foreach ($resultremaining1 as $resultrem) {

            $remainingtrips = $resultrem['pkg_remaining'];
            
          }
          
           if($remainingtrips == 0){
               
               
              $query2 ="DELETE FROM pkg_user WHERE user_id='$user_id' AND pkg_id='$userpkg' ";
                $pstmt2 = $con->prepare($query2);
                
                if($pstmt2->execute()){
                    
                  $_SESSION['message'] = "Your package is expired..Please pay and travel!!!";
                   header("Location:./stationUser.php?u=1");
                    
               }
                
          }
          
          if($remainingtrips >0){
              
               $usertripsremain = $remainingtrips - 1;
              
               $amount =0;
               $start = $_POST['start'];
               $destination = $_POST['destination'];
              
               $seat_no = $_POST['seat_no'];
               
               
          $ticket_query = "INSERT INTO station_user (user_id,Start_station,Destination,Reserve_seat,pkg_id,pkg_description,pkg_remaining,price) VALUES('$user_id','$start','$destination','$seat_no','$userpkg','$usertripsall','$usertripsremain','$amount')";
          $pstmt6 = $con->prepare($ticket_query);
         
         
           
          if($pstmt6->execute()){
              
              $query1 = "SELECT Station_issueId FROM station_user WHERE user_id = '$user_id'";
        
          $pstmt7 = $con->prepare($query1);
          $pstmt7->execute();
          $query1_run = $pstmt7->fetchAll(PDO::FETCH_ASSOC);
        

        if ($pstmt7->rowCount() > 0) {

          foreach ($query1_run as $data) {
            $Station_id = $data['Station_issueId'];
            echo $Station_id;

          }
          header("Location:ticket.php?u_id=$Station_id");
        }
      //  header("Location:ticket.php?u_id=$Station_id");

      
          }
          
         }
          }
        }
        
          else{
           
       $start1 = $_POST['start'];
       $destination1 = $_POST['destination'];
      
       $seat_no1 = $_POST['seat_no'];
      
       
            if($start1=='A' && $destination1=='B'){
             $amount1 = 200;  
           }
           elseif($start1=="B" && $destination1=="C"){
             $amount1 = 200;  
           }
           elseif($start1=="B" && $destination1=="A"){
             $amount1 = 200;  
           }
           elseif($start1=="C" && $destination1=="B"){
             $amount1 = 200;  
           }
           elseif($start1=="A" && $destination1=="C"){
               $amount1 = 400;  
            }
            elseif($start1=="C" && $destination1=="A"){
               $amount1 = 400;  
            }
           
          
            $userpkg1 ="-N/A-";
            $usertripsall1= "-N/A-";
            $usertripsremain1= "-N/A-";
         $ticket_query1 = "INSERT INTO station_user (user_id,Start_station,Destination,Reserve_seat,pkg_id,pkg_description,pkg_remaining,price) VALUES('$user_id','$start1','$destination1','$seat_no1','$userpkg1','$usertripsall1','$usertripsremain1','$amount1')";
         $pstmt8 = $con->prepare($ticket_query1);
        
          
         
          if($pstmt8->execute()){
              
           $query3 = "SELECT Station_issueId FROM station_user WHERE user_id = '$user_id'";
        
          $pstmt9 = $con->prepare($query3);
          $pstmt9->execute();
          $query3_run = $pstmt9->fetchAll(PDO::FETCH_ASSOC);
        

        if ($pstmt9->rowCount() > 0) {

          foreach ($query3_run as $data) {
            $Station_id = $data['Station_issueId'];
            echo $Station_id;

          }
          header("Location:ticket.php?u_id=$Station_id");
        }
      //  header("Location:ticket.php?u_id=$Station_id");

      
          }
            
        }
        
        
      }
      
      }
      
      else{
       $_SESSION['message'] = "Enter a valid User NIC Number";
    }
      
   }
   public function checkRemainingTrips($id){
    $dbcon = new DBConnector();
    $con = $dbcon->getConnection();
    try {

        $query = "SELECT *FROM station_user WHERE user_id = ? ORDER BY Station_issueId DESC LIMIT 1;";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1,$id);
        $pstmt->execute();
        $rs = $pstmt->fetch(PDO::FETCH_OBJ);
        return $rs;

    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
    return false;
}
 
 }
 
?>
