<?php
session_start();
include 'Classes/LiveChat.php';
include 'Classes/DBConnector.php';
use Classes\LiveChat;
use Classes\DBConnector;

$user1 = new LiveChat();
if ($_SESSION['auth_role'] == "user") {
    $user2 = $user1->getCommunicatorDetails();
}else {
    $user2 = $user1->getDetailsExceptCommunicator();
}


?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>chathome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="chat/chatprofile.css">
    <link rel="stylesheet" href="chat/chat.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body style="background: url(assets/img/33680.png) right / cover no-repeat fixed, rgb(63,70,79);"><!-- Start: nav bar -->
<?php include('includes/navbar.php'); ?>
<div style="background: url(assets/img/333580.jpg;) no-repeat;background-size: cover;">
    <h1 style="text-align: center;color: rgb(250,250,250);margin: 0px;padding: 6px;padding-top: 40px;padding-bottom: 40px;">
        Ask ME..</h1>
</div><!-- End: heading -->
<div id="chat-body" style="border: 3px solid white; border-radius: 25px"><!-- Start: Chat -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xl-4" style="width: 310px;"><!-- Start: Me -->
                <div class="row">
                    <div
                        class="col d-flex flex-nowrap justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center py-2 greenrowborder"
                        style="background: rgb(52,42,85);height: 4rem;color: var(--bs-body-bg);border-radius: 50px; padding: 10px 20px;">
                        <h5 class="mr-auto my-auto"><?php echo $_SESSION['user_name']?>&nbsp; &nbsp;&nbsp;</h5><img width="46" height="46" src="user.jpg" style="border-radius: 25px;">
                    </div>
                </div><!-- End: Me --><!-- Start: Search input -->
                <div class="row px-3 py-2">
                    <div class="col" style="border-radius: 25px;box-shadow: 0px 0px 5px var(--gray-dark);">
                        <form class="d-flex align-items-center px-2">
                            <!--                            <input-->
                            <!--                                    class="shadow-none form-control flex-shrink-1" type="search" id="myInput" placeholder="Search for names..." onkeyup="search();-->
                            <!--                                    style="border-radius: 13px;border-style: none;">-->

                        </form>
                    </div>
                </div><!-- End: Search input --><!-- Start: Chats -->
                <div class="row">
                    <div class="col" style="overflow-x: none;overflow-y: auto;max-height: 32.5rem;height: auto;">
                        <ul class="list-unstyled">
                            <?php
                            foreach ($user2 as $users){
                                ?>
                                <a href="chatprofile.php?uname=<?php echo $users->user_email?>" style="text-decoration: none">
                                    <li style="cursor:pointer;">
                                        <div class="card border-0" id="myTable" style="margin: 5px;border-radius: 50px;">
                                            <div class="card-body chat-card">
                                                <h6 class="text-nowrap text-truncate card-title"><img src="user.jpg" width="48" height="47" style="width: 46px;height: 46px;border-radius: 25px;">&nbsp; &nbsp; <?php echo $users->user_fname." ".$users->user_lname;?></h6>
                                                <div class="status-dot" style="display: flex">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div><!-- End: Chats -->
            </div>
            <div class="col  d-lg-block d-xl-block"><!-- Start: In Chat With -->
                <div class="row">
                    <div class="col d-flex align-items-lg-center align-items-xl-center border-start border-muted greenrowborder"
                         style="background: rgb(52,42,85);height: 4rem;color: var(--bs-body-bg);border-radius: 50px; padding: 10px 20px;"><button
                            class="btn d-block d-sm-block d-md-block d-lg-none d-xl-none border-0 my-auto" type="button"
                            style="width: 2.5rem;height: 2.5rem;"></button>
                        <h5 class="mr-auto my-auto"></h5><span class="my-auto"></span>
                    </div>
                </div><!-- End: In Chat With -->
                <div class="row" id="pic-and-name" style="text-align: center;">
                    <div class="col">
                        <div class="row">
                            <div class="col"><img width="310" height="289" src="001.gif"
                                                  style="margin-top: 86px;margin-bottom: 20px;border-radius: 50%"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1 style="margin-bottom: 10px;color: rgb(0,69,79)"></h1>
                            </div>
                        </div>
                    </div>
                </div><!-- Start: Box Message -->
                <div class="row px-3 py-2 greenrowborder" style="background: rgb(52,42,85);margin-top: 115px;color: var(--bs-body-bg);border-radius: 50px; padding: 10px 20px;">
                    <div class="col-9 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="padding: 0;text-align: center;">
                        <h6 style="text-align: center;padding-top: 10px;padding-bottom: 16.5px"></h6>
                    </div>
                    <div class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-nowrap d-md-flex justify-content-md-end p-0">
                    </div>
                </div><!-- End: Box Message -->
            </div>
        </div>
    </div><!-- End: Chat -->
</div>

<div id="back" style="text-align: center;margin-top: 54px;margin-bottom: 3vw"><a class="btn btn-primary ms-md-2 loginbtn btntype2" role="button"
                                                                                 href="index.php" style="border: solid white 1px; margin-right: 10px; background-color:rgb(52,42,85); border-radius: 30px; padding: 10px 20px;"><strong>&nbsp; Home</strong></a>
</div><!-- Start: footer -->
<?php include('includes/footer.php'); ?>
<!-- End: footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/search.js"></script>
</body>

</html>