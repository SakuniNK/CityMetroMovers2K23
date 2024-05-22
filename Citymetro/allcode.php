<?php
session_start();
require 'Classes/login_classes.php';
require 'Classes/loginCntrl.php';
require 'Classes/DBConnector.php';
use Classes\loginCntrl;
use Classes\DBConnector;

if(isset($_POST['signin_btn'])){
    $_SESSION['message'] = "Please Login";
    header("Location: signin.php");
    exit(0);
}else if(isset($_POST['signup_btn'])){
    $_SESSION['message'] = "Please Register";
    header("Location: register.php");
    exit(0);
}


if(isset($_POST['logout_btn'])){
    //session_destroy();

    $user = new loginCntrl(null,null);
    if($user->updateUser(Null,Null,$_SESSION['user_id'])){
        setcookie("remember_me", "", time() - (30 * 24 * 60 * 60 ),'/');
    }
    session_unset();

    $_SESSION['message'] = "Logged out Successfully";
    header("Location: signIn.php");
    exit(0);
}

?>

