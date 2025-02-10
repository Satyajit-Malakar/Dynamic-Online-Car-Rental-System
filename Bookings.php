<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental Portal</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

 
        
<!--Header-->
<?php include('includes/header2.php');?>
<!-- /Header --> 



<!-- Recent Car-->
<section class="section-padding gray-bg">
    <div class="container">
      <div class="section-header text-center">
        <h2 style="color: red;">You are not logged in.</h2>
        <span style="font-size: 20px;">Please Log-in to see your Reservation</span>
      </div>
      <div class="row">

        <!-- Nav tabs -->
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Recent Cars</a></li>
          </ul>
        </div>
        <!-- Recently Listed New Cars -->
        <section class="section-padding gray-bg">
          <div class="container">
            <div class="row">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="resentnewcar">
                  <?php
                  $sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName, tblvehicles.PricePerDay, tblvehicles.FuelType, tblvehicles.ModelYear, tblvehicles.Quantity, tblvehicles.id, tblvehicles.SeatingCapacity, tblvehicles.VehiclesOverview, tblvehicles.Vimage1 FROM tblvehicles JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand LIMIT 5";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                    echo '<div class="grid-container">'; // Start grid container
                    foreach ($results as $result) {
                      ?>
                      <div class="grid-item">
                        <div class="car-info-box">
                          <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                            <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                              class="img-responsive" alt="image">
                          </a>
                          <?php
                            $jsonFilePath = 'assets/Cars.json';
                            $jsonData = file_get_contents($jsonFilePath);
                            $vehiclesData = json_decode($jsonData, true);
                            $vehicles = $vehiclesData[2]['data']; 
                            $targetID = (string)$result->id; 
                            
                            // Initialize a variable to store the quantity
                            $vehicleQuantity = 'Vehicle not found or quantity not available';
                            
                            foreach ($vehicles as $vehicle): 
                                if ($vehicle['id'] === $targetID): 
                                    // Store the quantity in the variable
                                    $vehicleQuantity = $vehicle['Quantity'];
                                    break; // Stop the loop once the vehicle is found
                                endif;
                            endforeach;  
                            //echo $vehicleQuantity ;
                          ?>
                          <ul>
                            <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?>
                            </li>
                            <li><i class="fa fa-calendar"
                                aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> Model</li>
                            <li><i class="fa fa-user"
                                aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> seats</li>
                            <li style="<?php echo ($vehicleQuantity > 0) ? 'color: green;' : 'color: red;'; ?>">
                              <?php echo ($vehicleQuantity > 0) ? 'Available' : 'Not Available'; ?>
                            </li>
                          </ul>
                        </div>
                        <div class="car-title-m">
                          <h6><a
                              href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->VehiclesTitle); ?></a>
                          </h6>
                          <span class="price">$<?php echo htmlentities($result->PricePerDay); ?> /Day</span>
                        </div>
                        <div class="inventory_info_m">
                          <p><?php echo substr($result->VehiclesOverview, 0, 70); ?>...</p>
                        </div>
                      </div>
                      <?php
                    }
                    echo '</div>'; // End grid container
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <style>
          .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 items per row */
            grid-gap: 20px;
          }

          .grid-item {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Smooth transition for hover effects */
          }

          .grid-item:hover {
            transform: scale(1.05);
            /* Scales up the item to 105% of its original size */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            /* Adds shadow for pop-up effect */
          }
        </style>

        <!-- /Recent Car -->



<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>