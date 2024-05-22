<?php

namespace Classes;
use Classes\DBConnector;
use PDO;

class LiveChat{
    public function insertMessage($incomingUname, $outgoingUname, $message){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "INSERT INTO message(message_info, incoming_msg_uname, outgoing_msg_uname) VALUES (?,?,?)";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $message);
        $pstmt->bindValue(2, $incomingUname);
        $pstmt->bindValue(3, $outgoingUname);
        $pstmt->execute();
        if ($pstmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function getMsg($incomingUname, $outgoingUname){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT * FROM message
                  WHERE (outgoing_msg_uname=? AND incoming_msg_uname=?) OR (outgoing_msg_uname=? AND incoming_msg_uname=?) ORDER BY message_id  ";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $outgoingUname);
        $pstmt->bindValue(2, $incomingUname);
        $pstmt->bindValue(3, $incomingUname);
        $pstmt->bindValue(4, $outgoingUname);
        $pstmt->execute();
        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
        return $rs;
    }

    public function getCommunicatorDetails(){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT * FROM user WHERE user_role = 'communicator'";
        $pstmt = $con->prepare($query);
        $pstmt->execute();
        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
        return $rs;
    }

    public function getUserDetails($recivedUser){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT * FROM user where user_email=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1,$recivedUser);
        $pstmt->execute();
        $rs = $pstmt->fetch(PDO::FETCH_OBJ);
        return $rs;
    }
    public function getDetailsExceptCommunicator(){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT * FROM user WHERE user_role = 'user'";
        $pstmt = $con->prepare($query);
        $pstmt->execute();
        $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
        return $rs;
    }

}