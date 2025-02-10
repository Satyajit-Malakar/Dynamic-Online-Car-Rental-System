<?php

include('includes/config.php');
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
  //$bookingNumber = 350069966;
  $bookingNumber = $_POST['BN'];
    $status = 1;
    echo "hi";

    // Prepare and execute the SQL update
    $sql = "UPDATE tblbooking SET Status = :status WHERE BookingNumber = :bookingNumber";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':bookingNumber', $bookingNumber, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Status updated successfully');</script>";
    } else {
        echo "<script>alert('No changes made or booking number not found');</script>";
    }
    exit;
}
?>