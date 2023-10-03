<?php
session_start();

use classes\package;
require 'classes/package.php';

$display = new classes\package();
$packages = $display->pkgDisplay();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Package Details</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/pkg.css">
    </head>
    <body>

        <!-- Start: navbar -->
        <?php include('includes/navbar.php'); ?>

    <div class="main-container">
        <div class="background-container">
            <h1 style="color:white;"><strong>Choose your plan</strong></h1>
            <div class="price-row">
                <?php foreach ($packages as $package) { ?>
                    <div class="price-col package" style="background-color: rgb(57, 48, 83);">
                        <p><?php echo $package['Pkg_title']; ?></p>
                        <h3>Rs.<?php echo $package['Pkg_price']; ?><span>/month</span></h3>
                        <ul>
                            <li><?php echo $package['Pkg_description']; ?></li>
                        </ul>
                        <form method="POST" action="packageSelect.php">
                            <input type="hidden" name="id" value="<?php echo $package['Pkg_id']; ?>">
                            <input type="hidden" name="price" value="<?php echo $package['Pkg_price']; ?>">
                            <input type="hidden" name="title" value="<?php echo $package['Pkg_title']; ?>">
                            <button type="submit" name="confirmpkg" style="color: white;">Buy now</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
        <!-- Start: footer -->
        <?php include('includes/footer.php'); ?>
        <!-- End: footer -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>