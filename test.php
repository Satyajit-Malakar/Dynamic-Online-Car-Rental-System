<?php
// Read the JSON file
$jsonFilePath = 'assets/Cars.json';
$jsonData = file_get_contents($jsonFilePath);
$vehiclesData = json_decode($jsonData, true);

if (!$vehiclesData || !isset($vehiclesData[2]['data'])) {
    die("Error: Invalid JSON structure.");
}

$vehicles = $vehiclesData[2]['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .grid-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .grid-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s;
        }
        .grid-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }
        .grid-item:hover img {
            transform: scale(1.05);
        }
        .grid-item h2 {
            font-size: 18px;
            margin: 10px 0;
        }
        .grid-item p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
    <script>
        function redirectToEdit(carId, carPrice, carQuantity) {
            const url = 'edit_car.php?carId=' + encodeURIComponent(carId) + '&carPrice=' + encodeURIComponent(carPrice) + '&carQuantity=' + encodeURIComponent(carQuantity);
            window.location.href = url;
        }
    </script>
</head>
<body>
    <h1 style="text-align: center; padding: 20px;">Car Rental</h1>
    <div class="grid-container">
        <?php foreach ($vehicles as $vehicle): ?>
            <div class="grid-item" onclick="redirectToEdit('<?= htmlspecialchars($vehicle['id']) ?>', '<?= htmlspecialchars($vehicle['PricePerDay']) ?>', '<?= htmlspecialchars($vehicle['Quantity']) ?>')">
                <img src="<?= htmlspecialchars($vehicle['Vimage1']) ?>" alt="Image of <?= htmlspecialchars($vehicle['VehiclesTitle']) ?>">
                <h2><?= htmlspecialchars($vehicle['VehiclesTitle']) ?></h2>
                <p style="font-size: 16px; color: red;">Car ID: <?= htmlspecialchars($vehicle['id']) ?></p>
                <p>Quantity: <?= htmlspecialchars($vehicle['Quantity']) ?></p>
                <p>Price Per Day: $<?= htmlspecialchars($vehicle['PricePerDay']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
