<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['bookingId'] ?? null;
    $fromDate = $_POST['fromDate'] ?? null;
    $toDate = $_POST['toDate'] ?? null;

    if (empty($bookingId) || empty($fromDate) || empty($toDate)) {
        die('All fields are required.');
    }

    

    // Update query
    $sql = 'UPDATE tblbooking SET FromDate = :fromDate, ToDate = :toDate WHERE BookingNumber = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':fromDate', $fromDate);
    $stmt->bindParam(':toDate', $toDate);
    $stmt->bindParam(':id', $bookingId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo 'Dates updated successfully!';
    } else {
        echo 'Failed to update dates.';
    }
}
?>
