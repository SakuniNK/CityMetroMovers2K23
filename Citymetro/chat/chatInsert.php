<?php
require '../Classes/LiveChat.php';
require '../Classes/DBConnector.php';

echo "1";

//if ($_SERVER["REQUEST_METHOD"] === "POST"){
//    echo "2";
    $outgoingUname = $_POST["outgoingUname"];
    $incomingUname = $_POST["incomingUname"];
    $message = $_POST["message"];
    echo $message.$incomingUname.$outgoingUname;


    $mesg = new \Classes\LiveChat();
    $mesg->insertMessage($incomingUname,$outgoingUname,$message);
//}

echo "5";