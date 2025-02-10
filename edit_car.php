<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get car ID, price, and quantity from query parameters
$carId = $_GET['carId'] ?? '';
$carPrice = $_GET['carPrice'] ?? '';
$carQuantity = $_GET['carQuantity'] ?? '';
//echo $carPrice;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carId = $_POST['carId'] ?? null;
    $carPrice = $_POST['carPrice'] ?? null;
    $carQuantity = $_POST['carQuantity'] ?? null;

    if (empty($carId) || empty($carPrice) || empty($carQuantity)) {
        die("Car ID, price, and quantity must be provided.");
    }

    $filePath = 'assets/Cars.json';
    $jsonData = file_get_contents($filePath);
    if ($jsonData === false) {
        die("Failed to read from file.");
    }

    $data = json_decode($jsonData, true);
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        die("Error decoding JSON: " . json_last_error_msg());
    }

    // Assuming 'data' is always in the third index where car data is stored
    $found = false;
    foreach ($data[2]['data'] as $key => $car) {
        if ($car['id'] == $carId) {
            $data[2]['data'][$key]['PricePerDay'] = $carPrice;
            $data[2]['data'][$key]['Quantity'] = $carQuantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        die("Car with ID $carId not found.");
    }

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    $result = file_put_contents($filePath, $jsonData);
    if ($result === false) {
        die("Failed to write to file.");
    }

    echo '<script>
    window.onload = function() {
        alert("Car information updated successfully!");
        window.location = "index.php";
    };
</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }

        button, .home-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-align: center;
            text-decoration: none;
        }
        button:hover, .home-button:hover {
            background-color: #0056b3;
        }
        .home-button {
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Car Information</h1>
        <form method="POST" action="edit_car.php">
            <label for="carId">Car ID:</label>
            <input type="text" id="carId" name="carId" value="<?= htmlspecialchars($carId) ?>" readonly required>

            <label for="carPrice">Car Price:</label>
            <input type="number" id="carPrice" name="carPrice" value="<?= htmlspecialchars($carPrice) ?>" required>

            <label for="carQuantity">Car Quantity:</label>
            <input type="number" id="carQuantity" name="carQuantity" value="<?= htmlspecialchars($carQuantity) ?>" required>

            <button type="submit">Update Car</button>

            <a href="index.php" class="home-button">Home</a>
        </form>
        
    </div>
</body>
</html>
