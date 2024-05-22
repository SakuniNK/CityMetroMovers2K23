<?php
session_start();
include 'Classes/DBConnector.php';
include 'Classes/faq.php';
use Classes\DBConnector;
use Classes\faq;
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FAQ (1)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Verdana, Geneva, Tahoma, sans-serif&amp;display=swap">
    <link rel="stylesheet" href="assets/css/faq.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>
<!-- Start: navbar -->
<?php include('includes/navbar.php'); ?>

<div style="margin: 50px; border-radius: 30px; background-color: #f8f9fa;">
    <h1 style="text-align: center; font-family: 'Verdana, Geneva, Tahoma, sans-serif; color: #495057;">FAQ</h1>
    <p style="font-size: 20px; font-family: 'Verdana, Geneva, Tahoma, sans-serif; color: #495057;"></p>
    <!-- Start: FAQ -->
    <section class="py-4 py-xl-5" style="background-image: url('assets/img/faq.jpg'); background-size: cover;">
        <div class="container" style="margin-top: 0px;">
            <div class="text-white bg-dark border rounded border-0 p-4 p-md-5" style="background: #343a40; color: #ffffff;">

                <?php
                $getFaq = new faq();
                $faq = $getFaq->getFaq();
                $row = $faq[0];
                ?>

                <h2 class="fw-bold mb-3" style="font-family: 'Verdana, Geneva, Tahoma, sans-serif; background: #6c757d; color: #ffffff;">
                    <?php echo $row->title ?>
                </h2>
                <p class="mb-4"><?php echo $row->content ?></p>
                <div class="my-3"></div>
            </div>
        </div>

        <div class="container" style="margin-top: 20px;">
            <div class="text-white bg-dark border rounded border-0 p-4 p-md-5" style="background: #343a40; color: #ffffff;">
                <h2 class="fw-bold mb-3" style="font-family: 'Verdana, Geneva, Tahoma, sans-serif; background: #6c757d; color: #ffffff;">
                    <strong><?php $row = $faq[1];
                        echo $row->title ?></strong>
                </h2>
                <p class="mb-4"><?php echo $row->content ?></p>
                <div class="my-3"></div>
            </div>
        </div>

        <div class="container" style="margin-top: 20px; ">
            <div class="text-white bg-dark border rounded border-0 p-4 p-md-5" style="background: #343a40; color: #ffffff;">
                <h2 class="fw-bold mb-3" style="font-family: 'Verdana, Geneva, Tahoma, sans-serif; background: #6c757d; color: #ffffff;">
                    <strong><?php $row = $faq[2];
                        echo $row->title ?></strong>
                </h2>
                <p class="mb-4"><?php echo $row->content ?></p>
                <div class="my-3"></div>
            </div>
        </div>
    </section><!-- End: FAQ -->
</div>

<div>
    <div class="container" style="text-align: center; padding-bottom: 70px;">
        <div class="button-effect">
            <h2></h2>
            <a class="effect effect-5" href="chat.php" title="Ask Me" style="background: rgb(99,89,133); color: #ffffff;">Community Chat</a>
        </div>
    </div>
</div>

<!-- Start: footer -->
<?php include('includes/footer.php'); ?>
<!-- End: footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
