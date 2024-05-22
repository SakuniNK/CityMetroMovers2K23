<?php
require 'Classes/DBConnector.php';
use Classes\DBConnector;

if (isset($_GET['seat'])) {
    $seatNumber = $_GET['seat'];

    // Update the seat reservation status in the database
    try {
        $dbcon = new DBConnector();
        $con = $dbcon->getConnection();
        $sql = "UPDATE station_user SET is_reserved = 1 WHERE Reserve_seat = ?";
        $pstmt = $con->prepare($sql);
        $pstmt->bindValue(1, $seatNumber);
        $success = $pstmt->execute();

        if ($success) {
            header('Location: stationUser.php?seat='. $seatNumber);
        } else {
            echo "Error: Seat reservation failed.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Seat number not provided.";
}
?>
