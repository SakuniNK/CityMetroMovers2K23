<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION['auth'])) {

    $_SESSION['message'] = "Login to access dashboard";
    header("Location: signin.php");
    exit(0);
}

if ($_SESSION['auth_role'] != "moderator" && $_SESSION['auth_role'] != "admin") {
    $_SESSION['message'] = "You are not authorized as Admin or Moderator";
    header("Location: signin.php");
    exit(0);
}



require './Classes/Com_modarator.php';

use Classes\Com_modarator;

$Com_modarator = new Com_modarator();

use Classes\DBConnector;

$dbcon = new DBConnector();
?>

<?php
//    $year_select;
//    if($_SERVER["REQUEST_METHOD"]==="POST"){
//    
//    if(isset($_POST["submit"])){
//        
//            $year_select =$_POST["year"];
//           
//         
//    }
//}
?>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Verdana, Geneva, Tahoma, sans-serif
              &display=swap" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/31a106ca50.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand "
             style="background-color: rgb(99,89,133);">
            <!-- Navbar Brand-->

            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars" style="color: white;" onmouseover="animateButton(this, 'scale(1.5)')" onmouseout="animateButton(this, 'scale(1)')"></i></button>
            <script>
                function animateButton(button, transformation) {
                    button.style.transform = transformation;
                }
            </script>


        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">

                <nav class="sb-sidenav accordion" id="sidenavAccordion">
                    <div class="sb-sidenav-menu"
                         style="background-color: rgb(99,89,133);">


                        <div class="nav mt-4">

                            <a class="nav-link" href="moderatorindex.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>




                            <a class="nav-link" href="newfeed.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                News Editor
                            </a>


                            <a class="nav-link" href="tables.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>

                            <a class="nav-link" href="index.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                                Website
                            </a>

                            <a class="nav-link" href="station_master_dashbord.php" style="color: white;">
                                <div class="sb-nav-link-icon"><i class="fas fa-bus"></i></div>
                                Station Operator Panal
                            </a>

                            <a class="nav-link" href="faq_add.php" style="color: white;">
                            <div class="sb-nav-link-icon"><i class="far fa-circle-question"></i></div>
                            frequently asked questions
                        </a>

                        </div>
                    </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4 text-center" style="font-family: 'Verdana, Geneva, Tahoma, sans-serif
                            ', cursive;">Company Modarator</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashbord</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-2" style="width:20%" margin-right: 15%" >
                                 <div class="card  text-dark mb-4" style="background-image: url('totticket.jpeg'); background-size: cover; background-position: center;;">
                                    <div class="card-body"><i style="color: white" class="fa-solid fa-ticket fa-beat fa-lg"></i>
                                        <h4 class="h2_topics" style="color: white">Today Tickets</h4>
                                    </div>



                                    <h3 style="text-align: center; color: white;">

                                        <?php
                                        $count = $Com_modarator->today_Tickets();

                                        echo $count;
                                        ?>
                                    </h3>
                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2" style="width:20%" margin-right: 15%">
                                 <div class="card  text-dark mb-4" style="background-image: url('totusers.jpeg'); background-size: cover; background-position: center;">
                                    <div class="card-body"><i style="color: white" class="fa-solid fa-train fa-beat-fade fa-lg"></i>
                                        <h4 class="h2_topics" style="color: white">Station Users</h4>
                                    </div>

                                    <h3 style="text-align: center; color: white;">

                                        <?php
                                        $station = $Com_modarator->station_user();

                                        echo $station;
                                        ?>

                                    </h3>
                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2" style="width:20%" margin-right: 15%">
                                 <div class="card  text-dark mb-4" style="background-image: url('totusers.jpeg'); background-size: cover; background-position: center;;">
                                    <div class="card-body"><i style="color: white" class="fa-brands fa-usps fa-beat fa-lg"></i>
                                        <h4 class="h2_topics" style="color: white">Package Users</h4>
                                    </div>
                                    <h3 style="text-align: center; color: white;">
                                        <?php
                                        $pkg = $Com_modarator->pkg_user();

                                        echo $pkg;
                                        ?>

                                    </h3>
                                    <div class="card-footer d-flex align-items-center justify-content-between">


                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2" style="width:20%" margin-right: 15%">
                                 <div class="card  text-dark mb-4" style="background-image: url('totearnings.jpeg'); background-size: cover; background-position: center;;">
                                    <div class="card-body"><i style="color: white" class="fa-solid fa-wallet fa-beat fa-lg" ></i>
                                        <h4 class="h2_topics" style="color: white;">Today Earnins</h4>
                                    </div>



                                    <h3 style="text-align: center; color: white;">

                                        <?php
                                        $earnings = $Com_modarator->getEarnings();

                                        echo "Rs " . $earnings . ".00";
                                        ?>
                                    </h3>
                                    <div class="card-footer d-flex align-items-center justify-content-between">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top: 10%;">

                            <div class="col-xl-12">

                                <i class="fas fa-chart-bar me-1"></i>
                                Monthly Earnings :
                                <div class="card mb-4 card-22">
                                    <div class="card-header">


                                        <!--                                       <div style="display:flex;">
                                            <form method="POST" action="//">
                                                <label for="year">Choose Year:</label>
                                                <select id="cars" name="year">
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                </select>
                                                <input type="submit" name="submit" value="Enter" style="background-color: aquamarine">
                                               
                                            </form>
                                                
                                            </div>    -->
                                    </div>
                                    <div class="card-body">


                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                                        <script type="text/javascript">

                                            google.charts.load('current', {'packages': ['bar']});
                                            google.charts.setOnLoadCallback(drawStuff);

                                            function drawStuff() {
                                                var data = new google.visualization.arrayToDataTable([
                                                    ['Month', 'Income'],

<?php
$con1 = $dbcon->getConnection();
for ($x = 1; $x <= 12; $x++) {
    $query4 = "SELECT SUM(price) AS money,Month(Issue_date) AS Month FROM station_user WHERE Month(Issue_date)=$x";
    $pstmt = $con1->prepare($query4);
    $pstmt->execute();
    $rs4 = $pstmt->fetch(PDO::FETCH_ASSOC);
    $mon = $rs4['money'];
    ?>

                                                        ['<?php echo $x; ?>', '<?php echo $mon; ?>'],

    <?php
}
?>

                                                ]);

                                                var options = {

                                                    width: 900,
                                                    legend: {position: 'none'},

                                                    bars: 'horizontal', // Required for Material Bar Charts.
                                                    axes: {
                                                        x: {
                                                            0: {side: 'top', label: 'Income'} // Top x-axis.
                                                        }
                                                    },
                                                    bar: {groupWidth: "90%"}
                                                };

                                                var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                                                chart.draw(data, options);
                                            }
                                        </script>

                                        <body>
                                            <div id="top_x_div" style="width: 900px; height: 500px;"></div>
                                        </body>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <h2 class="d-flex justify-content-center" style="padding-top: 80px">Generate your monthly finance report</h2>
                    <div class="dropdown d-flex justify-content-center" style="padding-top:60px; padding-bottom:60px">
                        <button type="button" class="btn btn-outline-primary btn-lg dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" >
                            Generate Report
                        </button>
                        <form class="dropdown-menu p-4" method="POST" action="report_genarator.php">
                            <div class="mb-3">
                                <label for="exampleDropdownFormEmail2" class="form-label"><b>Select Year</b></label>
                                <select class="form-select" aria-label="Default select example" name="year">
                                    <option value="2026">2026</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option selected value="2023" >2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleDropdownFormPassword2" class="form-label"><b>Select Month</b></label>
                                <select class="form-select" aria-label="Default select example" name="month">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option selected value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-outline-dark">Generate</button>
                        </form>
                    </div>

                </main>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

</html>