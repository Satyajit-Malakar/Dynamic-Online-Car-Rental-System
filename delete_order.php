<?php
session_start();
include('includes/config.php'); // Ensure your database configuration is correctly included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['BN'])) {
    $bookingNumber = $_POST['BN'];

    //=========================================================
    $vid = $_POST['vid'];
    $targetID = (string)$vid; 


    
    $jsonFilePath = 'assets/Cars.json';
    $jsonData = file_get_contents($jsonFilePath);
    $vehiclesData = json_decode($jsonData, true);
    $vehicles = $vehiclesData[2]['data']; 


    // Initialize a variable to store the quantity
$vehicleQuantity = 'Vehicle not found or quantity not available';

foreach ($vehicles as $vehicle): 
    if ($vehicle['id'] === $targetID): 
        // Store the quantity in the variable
        $vehicleQuantity = $vehicle['Quantity'];
        break; // Stop the loop once the vehicle is found
    endif;
endforeach; 

//echo $vehicleQuantity;
   
    $update_quantity=intval($vehicleQuantity)+1;

    // Variable to check if the update was successful
    $updateSuccess = false;

    foreach ($vehicles as $key => $vehicle): 
        if ($vehicle['id'] === $targetID): 
            // Update the quantity in the array
            $vehiclesData[2]['data'][$key]['Quantity'] = $update_quantity;
            $updateSuccess = true;
            break; // Stop the loop once the vehicle is found
        endif;
    endforeach;

    // Check if update was successful and write back to the file
    if ($updateSuccess) {
        $newJsonData = json_encode($vehiclesData, JSON_PRETTY_PRINT);
        if (file_put_contents($jsonFilePath, $newJsonData)) {
            //echo "<p>Quantity updated successfully!</p>";
        } else {
            echo "<p>Error updating quantity.</p>";
        }
    } else {
        echo "<p>Vehicle ID not found.</p>";
    }

    //==========================================

    // Prepare and execute the SQL delete
    $sql = "DELETE FROM tblbooking WHERE BookingNumber = :bookingNumber";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':bookingNumber', $bookingNumber, PDO::PARAM_STR);
    if ($stmt->execute()) {
        echo "Order successfully canceled.";
    } else {
        echo "Failed to cancel the order.";
    }
} else {
    echo "No booking number provided.";
}
?>
