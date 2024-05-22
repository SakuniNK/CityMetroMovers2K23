<?php
session_start(); 
require_once './Classes/DBConnector.php';

use Classes\DBConnector;

include('message.php');

$id = null;
if (isset($_GET['u_id'])) {
  $id = $_GET['u_id'];
}

$dbcon = new DBConnector();
$con = $dbcon->getConnection();
$query1 = "SELECT * FROM station_user WHERE Station_issueId ='$id' ";
 $pstmt1 = $con->prepare($query1);
 $pstmt1->execute();
 $query1_run = $pstmt1->fetchAll(PDO::FETCH_ASSOC);

if ($pstmt1->rowCount()>0) {

  foreach ($query1_run as $data) {
    $user_id = $data['user_id'];
    $start = $data['Start_station'];
    $destination = $data['Destination'];
    
    $seat = $data['Reserve_seat'];
    $remain = $data['pkg_remaining'];
    $pkgid = $data['pkg_id'];
    $amount =$data['price'];
  }
}

$query2 = "SELECT user_fname FROM user WHERE user_id ='$user_id' ";
$pstmt2 = $con->prepare($query2);
 $pstmt2->execute();
 $query2_run = $pstmt2->fetchAll(PDO::FETCH_ASSOC);
 
if ($pstmt2->rowCount() > 0) {

  foreach ($query2_run as $data1) {
    $name = $data1['user_fname'];

  }
}

$query3 = "SELECT Pkg_title FROM package WHERE Pkg_id ='$pkgid' ";
$pstmt3 = $con->prepare($query3);
 $pstmt3->execute();
 $query3_run = $pstmt3->fetchAll(PDO::FETCH_ASSOC);

if ($pstmt3->rowCount() > 0) {

  foreach ($query3_run as $data2) {
    $namepkg = $data2['Pkg_title'];

  }
} else {
  $namepkg = "N/A";
}




?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Ticket</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles_tiket.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>
<?php include('includes/navbar.php'); ?> 
<div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 30px;"></div> 
  <section></section><!-- Start: Pretty Registration Form -->
  <div class="row register-form">
    <div class="col-md-8 offset-md-2" style="margin-top: -64px;margin-bottom: -16px;">
        <form class="custom-form" style="margin-top: 68px; border: solid black;" method="POST" action="qrcode.php">
        <h1>Ticket</h1>
        
        <div class="row form-group">
          <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Name</label></div>
          <div class="col-sm-6 input-column"><input class="form-control" type="text" name="name"
                                                    value="<?php echo $name ?>" readonly></div>
        </div>
        <div class="row form-group">
          
          <div class="col-lg-12" style="padding-top: 0px;margin-top: 26px;"><!-- Start: 1 Row 4 Columns -->
            <div class="container">
              <div class="row">
                <div class="col-md-3"><label class="col-form-label" for="name-input-field">From</label></div>
                <div class="col-md-3"><input class="form-control" type="text" name="from" value="<?php echo $start ?>"
                                             readonly></div>
                <div class="col-md-3"><label class="col-form-label" for="name-input-field">To</label></div>
                <div class="col-md-3"><input class="form-control" type="text" name="to"
                                             value="<?php echo $destination ?>" readonly></div>
              </div>
            </div><!-- End: 1 Row 4 Columns -->
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Amount</label></div>
          <div class="col-sm-6 input-column"><input class="form-control" type="text" name="a" value="<?php echo $amount; ?>" readonly>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Date</label></div>
          <div class="col-sm-6 input-column"><input class="form-control" type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Seat NO</label></div>
          <div class="col-sm-6 input-column"><input class="form-control" type="text" name="seat_no"
                                                    value="<?php echo $seat ?>" readonly></div>
        </div><!-- Start: 1 Row 4 Columns -->
        <div class="container">
          <div class="row">
            <div class="col-md-3"><label class="col-form-label" for="name-input-field">Package</label></div>
            <div class="col-md-3"><input class="form-control" type="text" name="pkg" value="<?php echo $namepkg; ?>" readonly>
            </div>
            <div class="col-md-3"><label class="col-form-label" for="name-input-field">Remain</label></div>
            <div class="col-md-3"><input class="form-control" type="text" name="remain" value="<?php echo $remain; ?>" readonly></div>
          </div>
        </div><button class="btn btn-light submit-button"
                      type="submit"
                      name="submit"
                      style="border: solid black 2px;
               border-radius: 50px;
               color: whitesmoke;
               background: rgb(99, 89, 133);
               transition: background-color 0.3s;"

                      onmouseout="this.style.backgroundColor='rgb(99, 89, 133)'"
                      onmouseover="this.style.backgroundColor='rgb(52, 42, 85)'">
                Genarate QR
            </button>

        </form>
    </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>