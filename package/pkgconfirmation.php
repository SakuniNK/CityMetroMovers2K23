<?php
session_start();

$packageID = $_SESSION['pkg_id'];
$packagePrice = $_SESSION['pkg_price'];
$packageTitle = $_SESSION['pkg_title'];
//$userID = $_SESSION['user_id'];
$userID ="CMU001";

include 'classes/user.php';  
include 'classes/route.php';

use classes\package;
use classes\route;

$confirm = new classes\user();
$conUser = $confirm->pkgconfirmUser();

if ($conUser > 0) {
    foreach ($conUser as $user) {
        $name = $user['user_fname'] . $user['user_lname'];
        $email = $user['user_email'];
    }
}

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Package Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pkgconfirm.css">
</head>

<body>
    <script>
        var selectedRouteId = null; // Initialize the variable to null
    </script>

    <?php include('includes/navbar.php'); ?>


    <!--        <div class="container-detailsDisplay">
            
            <h2>Your Package Details</h2>
            <p></p>
            
        </div>-->
    <div class="row register-form">
        <div class="col-md-8 offset-md-2">

        <div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 30px;"></div>

            <div class="custom-form-container" style="border: 3px solid black; padding: 20px;">

                <form class="custom-form" action="check_userid.php" method="POST"
                    style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 0px;">
                    <label class="form-label" style="text-align: center; margin-bottom: 26px; font-size: 16.52px;"><b>Your
                        Details are...</b></label>

                    <div class="row form-group" style="margin-bottom: 20px;">
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="user-id-input-field" name="userid">User ID</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="text" id="user-id-input-field"
                                value="<?php echo $userID; ?>" readonly>
                        </div>
                    </div>
                </form>

                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="name-input-field">Name</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" id="name-input-field" value="<?php echo $name; ?>"
                            readonly>
                    </div>
                </div>

                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="email-input-field">Email</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" id="email-input-field" value="<?php echo $email; ?>"
                            readonly>
                    </div>
                </div>

                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="name-input-field">Amount</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="amount"
                            value="<?php echo "Rs." . $packagePrice . ".00" ?>" readonly>
                    </div>
                </div>

                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="name-input-field">Package type</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="pkgType" value="<?= $packageTitle ?>" readonly>
                    </div>
                </div>

            </div>

            <div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 30px;"></div>


            <div class="container" style="margin-bottom: 28px;">
                <h1 style="text-align: center;font-size: 16.52px;">Select Your Route...</h1>
            </div>
            <div class="table-responsive" style="border-style: solid;text-align: center;">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="border-style: solid;">Route No</th>
                            <th>Start</th>
                            <th>End</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//                        $sql = "SELECT * FROM route";
//                        $stmt = mysqli_prepare($con, $sql);
//                        mysqli_stmt_execute($stmt);
//                        $result = mysqli_stmt_get_result($stmt);
                          $displayroute = new classes\route();
                          $routes = $displayroute->displayRoute();
                          
                          foreach ($routes as $route) {
                            $routeno = $route['Route_no'];
                            $routestrt = $route['Route_start'];
                            $routeend = $route['Route_end'];

                            ?>
                            <tr>
                                <form action="routeConfirm.php" method="POST">
                                    <td>
                                        <?php echo $routeno; ?>
                                    </td>
                                    <td>
                                        <?php echo $routestrt; ?>
                                    </td>
                                    <td>
                                        <?php echo $routeend; ?>
                                    </td>

                                    <input type="hidden" name="user_id" value="<?= $userID ?>" />
                                    <input type="hidden" name="pkg_id" value="<?= $packageID ?>" />
                                    <input type="hidden" name="route_id" value="<?= $row['Route_id']; ?>" />
                                    <td>
                                        <button class="btn btn-primary" type="submit" name='submit'
                                            style="background: rgb(156, 158, 254);">Select and Proceed to Pay.</button>
                                        <!--                                <script>
                                function selectRoute(routeId) {
                                    selectedRouteId = routeId; // Store the selected route_id
                                    alert("Enter your User ID"); // You can display an alert for testing purposes
                                }
                            </script>-->

                                    </td>

                                </form>
                            </tr>
                        <?php }
//                        mysqli_stmt_close($stmt);
//                        mysqli_close($con);
                        //endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>
        <div class="custom-form-container" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 30px;"></div>
    </div>


    <section></section>

    <!-- Start: Pretty Registration Form -->
    <script>


            // Function to handle the user ID entry
//        function handleUserIdEntry() {
//            var userId = document.getElementById("user-id-input-field").value;
//
//            console.log(userId);
//            $.ajax({
//                url: "check_userid.php",
//                type: "POST",
//                data: { userId: userId },
//                dataType: "json",
//                success: function (data) {
//                    // Update the name and email fields with the retrieved data
//                    document.getElementById("name-input-field").value = data.name;
//                    document.getElementById("email-input-field").value = data.email;
//                },
//                error: function () {
//                    alert("Error: Unable to retrieve user data.");
//                }
//            });
//        }
//
//        // Add an event listener to the "Enter" button
//        document.getElementById("user-id-submit-button").addEventListener("click", function (e) {
//            e.preventDefault(); // Prevent the form from submitting
//            handleUserIdEntry();
//        });
      //  </script>
    <!--        <div class="row register-form">
            <div class="col-md-8 offset-md-2">
                <form class="custom-form" action="check_userid.php" method="POST" style="margin-bottom: 1px; padding-bottom: 0px; padding-top: 0px;">
                    <label class="form-label" style="text-align: center; margin-bottom: 26px; font-size: 16.52px;">Please fill your details..</label>
                    <div class="row form-group" style="margin-bottom: 20px;"> 
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="user-id-input-field">User ID</label>
                        </div>
                        <div class="col-sm-4 input-column">
                            <input class="form-control" type="text" id="user-id-input-field">
                        </div>
                        <div class="col-sm-2 input-column">
                            <input class="form-control" type="submit" style="background: rgb(156, 158, 254);" id="user-id-submit-button" value="Enter">
                        </div>
                    </div>
                </form>
                <div class="row form-group" style="margin-bottom: 20px;"> 
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="name-input-field">Name</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" id="name-input-field" readonly>
                    </div>
                </div>
                <div class="row form-group" style="margin-bottom: 20px;"> 
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="email-input-field">Email</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" id="email-input-field" readonly>
                    </div>
                </div>


                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="name-input-field">Amount</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="amount" value="<?php echo "Rs." . $packagePrice ?>" readonly>
                    </div>
                </div>
                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <label class="col-form-label" for="name-input-field">Package type</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="pkgType" value="<?= $packageTitle ?>" readonly>
                    </div>
                </div>
                <div class="row form-group" style="margin-bottom: 20px;">
                    <div class="col-sm-4 label-column">
                        <p> Confirm your package</p>
                    </div>
                    <div class="col-sm-6 input-column">
                        <button type="submit" name="confirmpkg" style="background: rgb(156, 158, 254);">Confirm Package</button>
                    </div>
                </div>
            </div>
        </div>-->


    <!-- End: Pretty Registration Form -->

    <!-- Start: footer -->
    <?php include('includes/footer.php'); ?>
    <!-- End: footer -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>