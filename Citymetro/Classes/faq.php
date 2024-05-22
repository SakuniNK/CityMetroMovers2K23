<?php

namespace Classes;
use Classes\DBConnector;
use PDO;
use PDOException;

class faq
{

    public function insertMesssage($name,$email,$message){
        try {

            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $sql="INSERT INTO message(name, email, message) values(?,?,?)";
            $pstmt = $con->prepare($sql);
            $pstmt->bindValue(1,$name);
            $pstmt->bindValue(2,$email);
            $pstmt->bindValue(3,$message);
            $pstmt->execute();

        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function selectMessage(){
        try {
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $sql1="SELECT name, email, message, DATE_FORMAT(time, '%M %e at %l:%i %p') AS time2 from message";
            $pstmt = $con->prepare($sql1);
            $rs = $pstmt->execute();

            $messages = [];

            if ($pstmt->rowCount() > 0) {
                while ($row = $pstmt->fetch(PDO::FETCH_ASSOC)) {
                    $messages[] = $row;
                }
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $messages;
    }

    public function getFaq(){
        try {
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $sql1="SELECT * from faq";
            $pstmt = $con->prepare($sql1);
            $rs = $pstmt->execute();

            $faq = [];

            if ($pstmt->rowCount() > 0) {
                while ($row = $pstmt->fetch(PDO::FETCH_OBJ)) {
                    $faq[] = $row;
                }
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $faq;
    }

    public function addFaq($box, $topic, $message){
        try {
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $query = "UPDATE faq SET title=?, content=? WHERE container=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $topic);
            $pstmt->bindValue(2, $message);
            $pstmt->bindValue(3, $box);
            $pstmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



}
