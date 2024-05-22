<?php


session_start();
include 'Classes/LiveChat.php';
include 'Classes/DBConnector.php';
use Classes\LiveChat;
use Classes\DBConnector;
$recivedUser = $_GET["uname"];
$user = new LiveChat();
$user2 = $user->getUserDetails($recivedUser);

?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>chatprofile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chat/chatprofile.css">
    <link rel="stylesheet" href="chat/chat.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body style="background: url(assets/img/33680.png) right / cover no-repeat fixed, rgb(63,70,79);"><!-- Start: nav bar -->
<?php include('includes/navbar.php'); ?>
<div style="background: url(&quot;assets/img/doctor.jpg&quot;) no-repeat;background-size: cover;">
    <h1 style="text-align: center;color: rgb(250,250,250);margin: 0px;padding: 6px;padding-top: 40px;padding-bottom: 40px;">
        How can I help <b>YOU?</b>&nbsp;&nbsp;</h1>
</div><!-- End: heading -->
<div id="chat-body" style="border: 3px solid white; border-radius: 25px">
    <!-- Start: Chat -->
    <div class="container-fluid">
        <div class="row">
            <div class="col  d-lg-block d-xl-block">
                <!-- Start: In Chat With -->
                <div class="row";>
                    <div class="col d-flex align-items-lg-center align-items-xl-center border-start border-muted greenrowborder"
                         style="background: rgb(52,42,85);height: 4rem;color: var(--bs-body-bg);border-radius: 50px; padding: 10px 20px;">
                        <button class="btn d-block d-sm-block d-md-block d-lg-none d-xl-none border-0 my-auto" type="button"
                            style="width: 2.5rem;height: 2.5rem;"></button>
                        <img width="46" height="46" src="user.jpg" style="border-radius: 25px;">&nbsp;&nbsp;<h5 class="mr-auto my-auto"><?php echo $user2->user_fname . " " . $user2->user_lname;?></h5><!--<span class="my-auto" style="font-size: 13px;"> &nbsp;(<?php// echo $user2->status;?>)</span>-->
                    </div>
                </div>
                <!-- End: In Chat With -->
                <div class="row" id="pic-and-name" style="text-align: center;">
                    <div class="col">
                        <div class="chat-box">

                        </div>
                    </div>
                </div>
                <!-- Start: Box Message -->
                <div class="row px-3 py-2 greenrowborder" style="background: rgb(52,42,85);margin-top: 20px;color: var(--bs-body-bg);border-radius: 50px; padding: 10px 20px;">
                    <div class="col-9 col-sm-10 col-md-10 col-lg-10 col-xl-10" >
<!--                        <h6 style="text-align: center;padding-top: 1px;"></h6>-->
                        <form action="#" method="POST" class="typing-area">
                            <input type="hidden" name="outgoingUname" value="<?php echo $_SESSION['user_email'] ;?>">
                            <input type="hidden" name="incomingUname" value="<?php echo $user2->user_email;?>">
                            <input type="text" name="message" class="input-field" placeholder="Message..." style="border-radius: 50px; padding: 10px 20px;">
                            <button class="btn btn-light typing-area-btn" type="submit" style="border-radius: 50px; width: 70px; padding: 10px; background-color:rgb(159,145,204);" ><b>Send</b></button>
                            <script>
                                function animateButton(button, transformation) {
                                    button.style.transform = transformation;
                                }
                            </script>
                            
                        </form>
                    </div>
<!--                    <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-nowrap d-md-flex justify-content-md-end p-0">-->
<!---->
<!--                        <button class="btn btn-light h-100 w-auto" type="button" style="border-radius: 10px;">-->
<!--                            <i class="fa-solid fa-paper-plane fa-fade"></i>-->
<!--                        </button>-->
<!--                    </div>-->
                </div>
                <!-- End: Box Message -->
            </div>
        </div>
    </div><!-- End: Chat -->
</div>

<div id="back" style="text-align: center;margin-top: 54px;margin-bottom: 3vw"><a class="btn btn-primary ms-md-2 loginbtn btntype2" role="button"
                                                                                 href="index.php" style="border: solid white 1px; margin-right: 10px;border-radius: 50px; padding: 10px 20px; background-color:rgb(52,42,85);"><strong>&nbsp; Home</strong></a><a
            class="btn btn-primary ms-md-2 loginbtn" role="button" href="chat.php" style="border: solid white 1px;border-radius: 50px; padding: 10px 20px; background-color: rgb(52,42,85);">
        <strong>&nbsp; Back</strong></a>
</div><!-- Start: footer -->
<?php include('includes/footer.php'); ?>
<!-- End: footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="chat/chat.js"></script>
</body>

</html>