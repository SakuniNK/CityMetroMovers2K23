<?php
session_start();
require '../Classes/ticketing.php';
use Classes\ticketing;

$id = $_SESSION['user_id'];
$check = new ticketing();
$checkID = $check->checkRemainingTrips($id);

    if($checkID->pkg_remaining == "3"){
        header("Location: mail_Process.php");
}else{
        header("Location: ../index.php");
    }


?>
