<?php
session_start();
include "Classes/DBConnector.php";
include "Classes/packageDisplay.php";
use Classes\DBConnector;
use Classes\packageDisplay;

if(isset($_GET['u'])){
    if($_GET['u'] == "1"){
        $userID = $_SESSION['user_id'];
        $packageID = $_SESSION['pkg_id'];
        $route_id = $_SESSION['route_id'];

        $insertPkg = new packageDisplay();
        $insertPkg->insertUserPackage($userID, $packageID, $route_id);
        $rs = $insertPkg->getTrips($packageID);
        $trps = $rs->trips;
        $insertPkg->insertStationUser($userID,$packageID,$trps);



    }
}

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Payment_Gateway</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/payment.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>

<?php include('includes/navbar.php'); ?>

<div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 150px;"></div>

<div class="row .payment-dialog-row">
    <div class="col-12 col-md-4 offset-md-4">
        <div class="card credit-card-box">
            <div class="card-header">
                <h3 style="text-align: center;"><img class="img-fluid panel-title-image"
                                                     src="assets/img/accepted_cards.png">
                </h3>
            </div>
            <div class="card-body" style="background-image: url('assets/img/signin.jpg'); background-size: cover;">
                <div class="row">
                    <div class="row" style="padding-top: 100px; padding-bottom: 120px">
                        <div class="col-12">
                            <button type="button" onclick="paymentGateWay();"
                                    class="btn btn-success btn-lg d-block w-100"
                                    style="background: rgb(156, 158, 254); color: var(--bs-body-bg); font-weight: bold; width: fit-content;
    transition: background-color 0.3s, color 0.3s;"

                                    onmouseover="this.style.backgroundColor='rgb(52,42,85)'; this.style.color='#ffffff';"
                                    onmouseout="this.style.backgroundColor='rgb(99,89,133)'; this.style.color='var(--bs-body-bg)';">
                                Pay
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 150px; padding-top: 30px;"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="payment.js"></script>
</body>
<div>
    <?php include('includes/footer.php'); ?>
</div>

</html>