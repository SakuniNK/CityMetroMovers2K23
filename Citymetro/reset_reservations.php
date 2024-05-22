<?php
// Establish a database connection
$connection = mysqli_connect("localhost", "root", "root", "citymetromovers");

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Reset all seat reservations in the database
$sql = "UPDATE seats SET is_reserved = 0";

if (mysqli_query($connection, $sql)) {
    echo 'success';
} else {
    echo 'error';
}

mysqli_close($connection);
?>
