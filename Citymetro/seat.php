<?php
session_start();

require 'Classes/DBConnector.php';
use Classes\DBConnector;

$dbcon = new DBConnector();
$con = $dbcon->getConnection();

try {
    $query = "SELECT Reserve_seat FROM station_user WHERE is_reserved=1";
    $pstmt=$con->prepare($query);
    $pstmt->execute();
    $rs = $pstmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Reservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <style>
        body {
            background-color: rgb(177, 225, 255);
            
        }

        .seat-map {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); 
            gap: 10px;
            justify-content: center;
        }

        .seat {
            width: 80px;
            height: 80px;
            text-align: center;
            line-height: 80px;
            background-color: rgb(143, 106, 225);
            color: white;
            cursor: pointer;
            border-radius: 15px;
            font-size: 18px;
        }

        .reserved {
            background-color: #dc3545 !important;
            cursor: not-allowed;
        }

        #reset-button {
            margin-top: 20px;
        }

        
    </style>
</head>
<body>
<?php include('includes/navbar.php'); ?>


    <div class="container mt-5">
        <h1 class="text-center">Bus Seat Reservation</h1>
        <div class="text-center">
       <form action="reset_reservations.php" method ="POST">    
<button class="btn btn-danger" id="reset-button">Reset Reservations</button>
    </form>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Seat Map</h5>
                        <div class="seat-map" id="seat-map">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery scripts -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<form action="reserve_seat.php" method ="POST">

    <script>
        // JavaScript code for seat reservation
        $(document).ready(function() {
            // array to track seat reservations
            const reservedSeats = <?php echo json_encode($rs); ?>;

            // Function to generate seat buttons dynamically
            function generateSeatButtons() {
                const seatMap = document.getElementById('seat-map');
                for (let i = 1; i <= 44; i++) {
                    const seatButton = document.createElement('div');
                    seatButton.className = 'seat';
                    seatButton.innerText = i;
                    seatButton.id = `seat-${i}`;

                    // Check if the seat is reserved and apply the 'reserved' class
                    if (reservedSeats.includes(i)) {
                        seatButton.classList.add('reserved');
                        seatButton.removeEventListener('click', function() {
                            toggleSeatReservation(i);
                        });
                    } else {
                        seatButton.addEventListener('click', function() {
                            toggleSeatReservation(i);
                        });
                    }

                    seatMap.appendChild(seatButton);
                }
            }

            // Function to toggle seat reservation
            function toggleSeatReservation(seatNumber) {
                const seatId = `seat-${seatNumber}`;
                const seatButton = document.getElementById(seatId);
                if (reservedSeats.includes(seatNumber)) {

                    // Show a confirmation dialog before unreserving the seat
                    if (confirm(`Do you want to remove seat ${seatNumber} from the reservation?`)) {
                        const index = reservedSeats.indexOf(seatNumber);
                        if (index > -1) {
                            reservedSeats.splice(index, 1);
                        }
                        seatButton.classList.remove('reserved');
                    }
                } else {

                    // Reserve the seat
                    reservedSeats.push(seatNumber);
                    seatButton.classList.add('reserved');

                    // Redirect to stationUser.php
                    window.location.href = 'reserve_seat.php?seat=' + seatNumber;
                }
            }

            // Function to reset seat reservations
            $('#reset-button').click(function() {
                // Show a confirmation dialog before resetting all reservations
                if (confirm('Do you want to reset all reservations?')) {
                    reservedSeats.length = 0; // Clear the array
                    $('.seat').removeClass('reserved'); // Reset seat colors
                }
            });

            // Generate seat buttons when the page loads
            generateSeatButtons();
        });
    </script>

</form>
    <!---footer-->
<div style="padding-top: 100px;"><?php include('includes/footer.php'); ?></div>

   
</body>
</html>
