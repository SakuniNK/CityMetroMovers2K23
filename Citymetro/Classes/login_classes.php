<?php

namespace Classes;

use Classes\DBConnector;
use PDO;
use PDOException;

class Login_classes
{
    protected function getUser($user_email, $user_password){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "SELECT * FROM user WHERE user_email=?;";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $user_email);

            if (!$pstmt->execute()) {
                throw new Exception("Statement execution failed");
            }

            $rs = $pstmt->fetch(PDO::FETCH_ASSOC);

            if (!$rs) {
                $_SESSION['message'] = "User not found";
                header("Location:../signIn.php?error=user_not_found");
                exit();
            }

            $hashed_password = md5($user_password);

            if ($hashed_password != $rs['user_password']) {
                $_SESSION['message'] = "email or password does not match";
                header("Location:../signIn.php?error=email_or_password_does_not_match");
                exit();
            } else {

                $_SESSION['user_id'] = $rs['user_id'];
                $_SESSION['auth'] = true;
                $_SESSION['user_contactNo'] = $rs['user_contactNo'];
                $_SESSION['user_email'] = $rs['user_email'];
                $_SESSION['user_fname'] = $rs['user_fname'];
                $_SESSION['user_lname'] = $rs['user_lname'];
                $_SESSION['auth_role'] = $rs['user_role'];
                $user_id = $rs['user_id'];
                $user_name = $rs['user_fname']." ".$rs['user_lname'];
                $_SESSION['user_name'] = $user_name;
                $user_nic = $rs['user_nic'];
                $user_contactNo = $rs['user_contactNo'];
                $user_email = $rs['user_email'];
                $_SESSION['auth_user'] = [
                    'user_id' => $rs['user_id'],
                    'user_name' => $user_name,
                    'user_nic' => $user_nic,
                    'user_contactNo' => $user_contactNo,
                    'user_email' => $user_email,

                ];

            }
        } catch (PDOException $e) {
            // Log the error or handle it in a more secure way
            echo "Database Error: " . $e->getMessage();
        } catch (Exception $e) {
            // Log the error or handle it in a more secure way
            echo "Error: " . $e->getMessage();
        }
    }

    public function isValidToken($token) {
        $msg = "";
        try {
            $query = "SELECT * FROM user WHERE cookie_token = ?";
            $dbcon = new DBConnector();
            $con = $dbcon->getConnection();
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $token);
            $pstmt->execute();


            if ($pstmt->rowCount() > 0) {
                $msg = "sql_run";
                $rs = $pstmt->fetch(PDO::FETCH_ASSOC);
                $db_expiry_date = $rs['expiry_date'];
                $tim = time();
                $dt = $db_expiry_date;
                $as =$dt - $tim;
                if (($as) > 0) {
                    $msg = $msg . "&rs_ok";
                    session_start();

                    $_SESSION['user_id'] = $rs['user_id'];
                    $_SESSION['auth'] = true;
                    $_SESSION['user_contactNo'] = $rs['user_contactNo'];
                    $_SESSION['user_email'] = $rs['user_email'];
                    $_SESSION['user_fname'] = $rs['user_fname'];
                    $_SESSION['user_lname'] = $rs['user_lname'];
                    $_SESSION['auth_role'] = $rs['user_role'];
                    $user_id = $rs['user_id'];
                    $user_name = $rs['user_fname']." ".$rs['user_lname'];
                    $_SESSION['user_name'] = $user_name;
                    $user_nic = $rs['user_nic'];
                    $user_contactNo = $rs['user_contactNo'];
                    $user_email = $rs['user_email'];
                    $_SESSION['auth_user'] = [
                        'user_id' => $rs['user_id'],
                        'user_name' => $user_name,
                        'user_nic' => $user_nic,
                        'user_contactNo' => $user_contactNo,
                        'user_email' => $user_email,

                    ];
                    return true;
                } else {
                    $msg = $msg . "&rs_err&&$as&&$dt&&$tim";
                    return false;
                }
            } else {
                $msg = " sql_err";
                return false;
            }
        } catch (PDOException $exc) {
            die("Error in User class's isValidToken function: " . $exc->getMessage());
        }
    }

    public function update($token, $expiry, $user_id) {
        $query = "UPDATE user SET cookie_token = ?, expiry_date = ? WHERE user_id = ?";
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $token);
        $pstmt->bindValue(2, $expiry);
        $pstmt->bindValue(3, $user_id);
        $pstmt->execute();
        return ($pstmt->rowCount() > 0);
    }

    protected function userEmail($user_email){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        try {
            $query = "SELECT user_email FROM user WHERE user_email = ?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1,$user_email);
            $rs = $pstmt->execute();
            if($pstmt->rowCount()>0){
                $result = true;
            }else{
                $result = false;
            }
        }catch (PDOException $exc){
            echo $exc->getMessage();
        }
        return $result;
    }

    protected function userStatus($user_email){
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();

        try {
            $query = "SELECT user_status FROM user WHERE user_email=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $user_email);
            $pstmt->execute(); // You need to execute the prepared statement
            $rs = $pstmt->fetch(PDO::FETCH_ASSOC);

            if ($rs !== false) {
                $status = $rs['user_status'];
                if ($status == "Active") {
                    $result = true;
                } else if($status == "Banned"){
                    $result = false;
                }else{
                    $_SESSION['message'] = "User not found";
                    header("Location:../signIn.php?error=user_not_found");
                    exit();
                }
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        return $result;
    }

}
