<?php
session_start();
$packagePrice = (string)$_SESSION['pkg_price'];
$packageTitle = (string)$_SESSION['pkg_title'];
$user_fname = (string)$_SESSION['user_fname'];
$user_lname = (string)$_SESSION['user_lname'];
$user_email = (string)$_SESSION['user_email'];
$user_contactNo = (string)$_SESSION['user_contactNo'];

$amount = $packagePrice;
$merchant_id = "1224506";
$order_id = uniqid();
$merchant_secret = "ODA4NDM0MDA4MzU5MjU4NTg0MjkxMTQxODg1NTIwMDI5MzczMjg=";
$currency = "LKR";

$hash = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        number_format($amount, 2, '.', '') .
        $currency .
        strtoupper(md5($merchant_secret))
    )
);

$array = [];
$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["hash"] = $hash;
$array["items"] = $packageTitle;
$array["first_name"] = $user_fname;
$array["last_name"] = $user_lname;
$array["email"] = $user_email;
$array["phone"] = $user_contactNo;

$jsonObj = json_encode($array);

echo $jsonObj;



