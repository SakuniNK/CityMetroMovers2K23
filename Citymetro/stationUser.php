<?php
session_start();
require_once "admin/config/dbcon.php";
require_once './Classes/ticketing.php';

use Classes\ticketing;
include('message.php');



 if (isset($_POST['submit'])) {
  if (empty($_POST['User_nic']) || empty($_POST['start']) || empty($_POST['destination']) || empty($_POST['seat_no'])) {

    $_SESSION['message'] = "Please fill all fields..";

  } else {
    if (isset($_POST['User_nic'])) {

      $user_nic = $_POST['User_nic'];
      
      $ticketIssue = new ticketing();
      $ticketIssue->ticketIssuing($user_nic);

    }
  }
}
?>



<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>station_user interface</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/stationUser.min.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>

<body>
  <?php include('includes/navbar.php'); ?>
  <div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 50px;"></div>
  <!-- Start: Pretty Registration Form -->
  <div class="row register-form">
    <div class="col-md-8 offset-md-2" style="margin-top: -48px; padding-top: 50px; padding-bottom: 50px;">
      <form class="custom-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
        style="padding-top: 4px;color: var(--bs-btn-disabled-color);box-shadow: 0px 0px 3px;margin-top: 36px;">
        <div class="row form-group" style="margin-top: 28px;">
          <div class="col-sm-4 label-column" style="text-align: center;"><label class="col-form-label"
              for="name-input-field">User NIC</label></div>
            <div class="col-sm-6 input-column"><input class="form-control" type="text" name="User_nic"
              style="box-shadow: 0px 0px 5px;">
          </div>
          <div class="col-lg-12" style="margin-top: 25px;text-align: center;"><!-- Start: 2 Rows 1+1 Columns -->
            <div class="container">
              <div class="row">
                <div class="col-md-12" style="background: rgb(156, 158, 254);border-style: initial;"><label
                    class="col-form-label">Stations</label></div>
              </div>
            </div><!-- End: 2 Rows 1+1 Columns --><!-- Start: 1 Row 3 Columns -->
            <div class="container">
              <div class="row">
                <div class="col-md-4" style="border-style: initial;"><label class="col-form-label">Gampaha - A</label>
                </div>
                <div class="col-md-4" style="border-style: initial;"><label class="col-form-label">Colombo - B</label>
                </div>
                <div class="col-md-4" style="border-style: initial;"><label class="col-form-label">Kaluthara - C</label>
                </div>
              </div>
            </div><!-- End: 1 Row 3 Columns -->
          </div>
        </div>



        <div class="row form-group">
          <div class="col-sm-4 label-column" style="text-align: center;"><label class="col-form-label"
              for="name-input-field">Start</label></div>
          <div class="col-sm-6 input-column"><select class="form-select" aria-label="Default select example" name="start" style="box-shadow: 0px 0px 5px;">
                  <option selected value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                  
                                </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4 label-column" style="text-align: center;"><label class="col-form-label"
              for="email-input-field" style="text-align: left;">Destination</label></div>
          <div class="col-sm-6 input-column"><select class="form-select" aria-label="Default select example" name="destination" style="box-shadow: 0px 0px 5px;">
                                    <option value="A">A</option>
                                    <option selected value="B">B</option>
                                    <option value="C">C</option>
                                  
                                </select>
          </div>
        </div>
        
        <div class="row form-group">

          <div class="col-sm-4 label-column" style="text-align: center;"><label class="col-form-label"
              for="email-input-field" style="text-align: left;">Seat NO (A1,B2..)</label>

          </div>
            <div class="col-sm-6 input-column">
                <div class="input-group">
                    <?php
                    $seatNumber = null;
                    if (isset($_GET['seat'])) {
                        // Get the seat value from the URL
                        $seatNumber = $_GET['seat'];
                    }

                    ?>
                    <input class="form-control" type="text" name="seat_no" value="<?php echo $seatNumber;?>" style="box-shadow: 0px 0px 5px;">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" style="background: rgb(156, 158, 254); transition: background-color 0.3s; border-radius: 30px; margin: 10%; border: solid black 2px; color: black;" onmouseover="this.style.backgroundColor='rgb(52, 42, 85)'" onmouseout="this.style.backgroundColor='rgb(156, 158, 254)'" onclick="window.location.href='seat.php';"><b>Seat</b></button>

                    </div>

                </div>
            </div>



        </div><button class="btn btn-light submit-button" type="submit" name="submit"
          style="background: rgb(156, 158, 254);border: solid black 3px;border-radius: 50px; color:black;">Enter</button>
      </form>
    </div>


  </div><!-- End: Pretty Registration Form --><!-- Start: Footer Basic -->
  <?php include('includes/footer.php'); ?><!-- End: Footer Basic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>