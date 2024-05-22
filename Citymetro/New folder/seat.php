<?php
include 'reserve_seat.php';
//include 'reset_reservations.php';
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Reservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <!---header-->
<div class="row mb-5"
    style="background: linear-gradient(90deg, rgb(177, 225, 255), rgb(156, 158, 254) 100%), rgb(156, 158, 254);">
    <div class="col-md-8 col-xl-6 text-center mx-auto" style="margin-bottom: 1px;">
      <h2 style="padding-top: 18px;"><img
          src="assets/img/citymetromovers-low-resolution-logo-black-on-transparent-background.png"
          style="width: 160px;height: 70px;"></h2>
      <p class="w-lg-50"></p>
    </div>
  </div>


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
            const reservedSeats = [];

            // Function to generate seat buttons dynamically
            function generateSeatButtons() {
                const seatMap = document.getElementById('seat-map');
                for (let i = 1; i <= 44; i++) {
                    const seatButton = document.createElement('div');
                    seatButton.className = 'seat';
                    seatButton.innerText = i;
                    seatButton.id = `seat-${i}`;
                    seatButton.addEventListener('click', function() {
                        toggleSeatReservation(i);
                    });
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
                    window.location.href = 'stationUser.php?seat=' + seatNumber;
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
    
    <footer class="text-center" style="background: linear-gradient(-86deg, rgb(108,74,182) 11%, rgb(185,224,255) 86%);">
        <div class="container mt-5" style="padding-top: 20px;">
        <div class="container text-muted py-4 py-lg-5">
          <ul class="list-inline text-decoration-none" style="color: var(--bs-tertiary-bg);">
            <li class="list-inline-item me-4" style="font-family: Audiowide, serif;color: var(--bs-secondary-bg);"><a
                href="#" style="color: var(--bs-tertiary-bg);font-family: Audiowide, serif;">About us</a></li>
            <li class="list-inline-item me-4" style="font-family: Audiowide, serif;"><a href="#"
                style="color: var(--bs-tertiary-bg);font-family: Audiowide, serif;">Contact us</a></li>
            <li class="list-inline-item" style="color: var(--bs-tertiary-bg);font-family: Audiowide, serif;"><a href="#"
                style="color: var(--bs-tertiary-bg);font-family: Audiowide, serif;">Feedbacks</a></li>
          </ul>
          <ul class="list-inline">
            <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                <path
                  d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                </path>
              </svg></li>
            <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                <path
                  d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
                </path>
              </svg></li>
            <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                <path
                  d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
                </path>
              </svg></li>
          </ul>
          <p class="mb-0" style="font-family: Audiowide, serif;">Copyright © 2023 CityMetroMovers&nbsp; All rights reserved
          </p>
        </div>
       </div>  
      </footer>
   
</body>
</html>
