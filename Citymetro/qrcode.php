<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
// Include the qrlib file 
require 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;


$name = $_POST['name'];
$from = $_POST['from'];
$to =$_POST['to'];
$amount= $_POST['a'];
$seat_no =$_POST['seat_no'];
$pkg =$_POST['pkg'];
$remain =$_POST['remain'];

//name.$from.$to.$amount.$seat_no.$pkg.$remain
$text = "Date:-".date("Y-m-d")." Name:-".$name. "  From:-".$from."  To:-".$to."  Amount:-Rs ".$amount."  Seat Number:-".$seat_no."  Package:-".$pkg."  Remain:-".$remain;
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/navbar.css">
    </head>
    <body>
    <?php include('includes/navbar.php'); ?>
<div style="padding-top: 80px; padding-bottom: 80px;">
    <center>
        <img src="<?php echo (new QRCode)->render($text);?>" height="500" width="500" alt="QR Code"><br>
        <h1>Scan this..!</h1>
    </center>
</div>


    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
