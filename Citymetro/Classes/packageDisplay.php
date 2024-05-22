<?php

namespace Classes;
use Classes\DBConnector;
use Exception;
use PDO;
use PDOException;

class packageDisplay
{
    public function getPackage()
    {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "SELECT * FROM package";
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC); // Fetch data as an associative array
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $rs;
    }

    public function getUser($userID)
    {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "SELECT * FROM user WHERE user_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1,$userID);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $rs;
    }

    public function getRouteInfo()
    {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "SELECT * FROM route";
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC); // Fetch data as an associative array
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $rs;
    }

    public function insertUserPackage($userID, $packageID, $route_id)
    {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "INSERT INTO pkg_user (User_id, Pkg_id, Route_id) VALUES (?, ?, ?)";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1,$userID);
            $pstmt->bindValue(2,$packageID);
            $pstmt->bindValue(3,$route_id);
            $pstmt->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function getTrips($packageID){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "SELECT trips FROM package WHERE Pkg_id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1,$packageID);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_OBJ);
            return $rs;

        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return false;
    }

    public function insertStationUser($userID,$packageID,$trips){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "INSERT INTO station_user (user_id,pkg_id,pkg_description,pkg_remaining) VALUES(?,?,?,?)";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1,$userID);
            $pstmt->bindValue(2,$packageID);
            $pstmt->bindValue(3,$trips);
            $pstmt->bindValue(4,$trips);
            $pstmt->execute();

        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
