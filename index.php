<?php
session_start();
include ('includes/config.php');
if(isset($_SESSION['login'])){
$e_mail=$_SESSION['login'];
//echo $e_mail;
}
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
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
    data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

  <style>
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      /* Adjust the size as needed */
      gap: 20px;
      padding: 20px;
    }

    .grid-item {
      border: 1px solid #ccc;
      box-shadow: 0 0 10px #ccc;
      padding: 10px;
      text-align: center;
    }

    img {
      width: 100%;
      /* Adjust the size as needed */
      height: auto;
    }

    /* Adjusts padding and margin for the sections and their containers */
    .section-padding {
      padding-top: 30px;
      /* reduced top padding, adjust this value as needed */
      padding-bottom: 30px;
      /* reduced bottom padding, adjust this value as needed */
    }

    /* Reduce margin around each grid item which might be contributing to large gaps */
    .grid-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      /* 3 items per row */
      grid-gap: 20px;
      margin-top: 10px;
      /* Smaller top margin */
      margin-bottom: 10px;
      /* Smaller bottom margin */
    }

    .grid-item {
      border: 1px solid #ccc;
      padding: 10px;
      background-color: #f9f9f9;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      /* Smooth transition for hover effects */
      cursor: pointer;
      /* Indicates that an item is interactive */
    }

    .grid-item:hover {
      transform: scale(1.05);
      /* Scales up the item to 105% of its original size */
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      /* Adds shadow for "pop-up" effect */
    }
  </style>

</head>

<body>

  <!-- Start Switcher -->
  <?php include ('includes/colorswitcher.php'); ?>
  <!-- /Switcher -->

  <!--Header-->
  <?php 
  
    include ('includes/header.php');
  
  ?>
  <!-- /Header -->

  <!-- Banners -->
  <section id="banner" class="banner-section">
    <div class="container">
      <div class="div_zindex">
        <div class="row">
          <div class="col-md-5 col-md-push-7">
            <div class="banner_content">
              <h1>&nbsp;</h1>
              <p>&nbsp; </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Banners -->


  <!-- Recent Car-->
  <section class="section-padding gray-bg">
    <div class="container">
      <div class="section-header text-center">
        <h2>Find the Best <span>CarForYou</span></h2>
        <p>Whether you're in the market for a luxurious sedan, a sturdy SUV, or an eco-friendly electric car, our user-friendly platform makes it easy to find, compare, and purchase the perfect car that fits your lifestyle and budget. At AutoHub, we are committed to providing you with detailed vehicle information, transparent pricing, and a seamless online buying experience.</p>
      </div>
      <div class="row">

        <!-- Nav tabs -->
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Car</a></li>
          </ul>
        </div>
        <!-- Recently Listed New Cars -->
        <section class="section-padding gray-bg">
          <div class="container">
            <div class="row">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="resentnewcar">
                  <?php
                  $sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName, tblvehicles.PricePerDay, tblvehicles.FuelType, tblvehicles.ModelYear, tblvehicles.Quantity, tblvehicles.id, tblvehicles.SeatingCapacity, tblvehicles.VehiclesOverview, tblvehicles.Vimage1 FROM tblvehicles JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand LIMIT 9";
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
                          <ul >
                            <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?>
                            </li>
                            <li><i class="fa fa-calendar"
                                aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> Model</li>
                            <li><i class="fa fa-user"
                                aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> seats</li>
                            <li style="<?php echo ($vehicleQuantity > 0) ? 'color: white;' : 'color: red;'; ?>">
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


        <!-- Coming Up -->

        <section class="section-padding gray-bg">
          <div class="container">
            <div class="row">
              <!-- Nav tabs -->
              <div class="recent-tab">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Coming
                      Up</a></li>
                </ul>
              </div>
              <!-- Recently Listed New Cars -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="resentnewcar">
                  <?php
                  // Assuming JSON data is loaded properly
                  $jsonFilePath = 'assets/Cars2.json';
                  $jsonData = file_get_contents($jsonFilePath);
                  $vehiclesData = json_decode($jsonData, true);
                  $vehicles = $vehiclesData[2]['data']; // Adjust based on your JSON structure
                  ?>
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
                      cursor: pointer;
                      /* Indicates that an item is interactive */
                    }

                    .grid-item:hover {
                      transform: scale(1.05);
                      /* Scales up the item to 105% of its original size */
                      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                      /* Adds shadow for "pop-up" effect */
                    }
                  </style>
                  <div class="grid-container">
                    <?php foreach ($vehicles as $vehicle): ?>
                      <div class="grid-item"
                        onclick="showAvailability(<?= htmlspecialchars(json_encode($vehicle['Available'])); ?>);">
                        <img src="<?= htmlspecialchars($vehicle['Vimage1']) ?>"
                          alt="Image of <?= htmlspecialchars($vehicle['VehiclesTitle']) ?>"
                          style="width: 100%; height: auto;">
                        <h2><?= htmlspecialchars($vehicle['VehiclesTitle']) ?></h2>
                        <p>Price Per Day: $<?= htmlspecialchars($vehicle['PricePerDay']) ?></p>
                        <p>Model Year: <?= htmlspecialchars($vehicle['ModelYear']) ?></p>
                        <p>Available <?= htmlspecialchars($vehicle['Available']) ?></p>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <script>
                    function showAvailability(available) {
                      if (available > 0) {
                        alert('This vehicle is available.');
                      } else {
                        alert('Not available now.');
                      }
                    }
                  </script>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- /Coming Up -->

        <!-- Fun Facts-->
        <section class="fun-facts-section">
          <div class="container div_zindex">
            <div class="row">
              <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                  <div class="cell">
                    <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
                    <p>Years In Business</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                  <div class="cell">
                    <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
                    <p>New Cars For Sale</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                  <div class="cell">
                    <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
                    <p>Used Cars For Sale</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                  <div class="cell">
                    <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
                    <p>Satisfied Customers</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Dark Overlay-->
          <div class="dark-overlay"></div>
        </section>
        <!-- /Fun Facts-->


        <!--Testimonial -->
        <section class="section-padding testimonial-section parallex-bg">
          <div class="container div_zindex">
            <div class="section-header white-text text-center">
              <h2>Our Satisfied <span>Customers</span></h2>
            </div>
            <div class="row">
              <div id="testimonial-slider">
                <?php
                $tid = 1;
                $sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid limit 4";
                $query = $dbh->prepare($sql);
                $query->bindParam(':tid', $tid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) { ?>


                    <div class="testimonial-m">

                      <div class="testimonial-content">
                        <div class="testimonial-heading">
                          <h5><?php echo htmlentities($result->FullName); ?></h5>
                          <p><?php echo htmlentities($result->Testimonial); ?></p>
                        </div>
                      </div>
                    </div>
                  <?php }
                } ?>



              </div>
            </div>
          </div>
          <!-- Dark Overlay-->
          <div class="dark-overlay"></div>
        </section>
        <!-- /Testimonial-->


        <!--Footer -->
        <?php include ('includes/footer.php'); ?>
        <!-- /Footer-->

        <!--Back to top-->
        <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a>
        </div>
        <!--/Back to top-->

        <!--Login-Form -->
        <?php include ('includes/login.php'); ?>
        <!--/Login-Form -->

        <!--Register-Form -->
        <?php include ('includes/registration.php'); ?>

        <!--/Register-Form -->

        <!--Forgot-password-Form -->
        <?php include ('includes/forgotpassword.php'); ?>
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

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>