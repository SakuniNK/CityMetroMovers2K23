<?php
require '../Classes/LiveChat.php';
require '../Classes/DBConnector.php';
use Classes\LiveChat;
use Classes\DBConnector;


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $outgoingUname = $_POST["outgoingUname"];
    $incomingUname = $_POST["incomingUname"];
    $output = "";

//    echo $message.$incomingUname.$outgoingUname;
    $secureMsgObj = new LiveChat();
    $user = $secureMsgObj->getMsg($incomingUname, $outgoingUname);
    foreach ($user as $userMessage){
        if ($userMessage->outgoing_msg_uname === $outgoingUname) {
            $output .= '<div class=" chat chat-outgoing">
                             <div class="details">
                                  <p>'. $userMessage->message_info .'</p>
                             </div>
                         </div>';
        }else{
            $output .= '<div class=" chat chat-incoming">
                            
                                <div class="details">
                                    <p>'. $userMessage->message_info .'</p>
                                </div>
                         </div>';
        }
    }
    echo $output;
}