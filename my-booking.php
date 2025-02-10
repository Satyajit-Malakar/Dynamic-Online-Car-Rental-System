<?php
session_start();
error_reporting(0);
include ('includes/config.php');
echo $targetID;
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  ?><!DOCTYPE HTML>
  <html lang="en">

  <head>

    <title>Car Rental Portal - My Booking</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
      data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
      href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
      href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
      href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <!-- Google-Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>

  <body>

    <!-- Start Switcher -->
    <?php include ('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include ('includes/header2.php'); ?>
    <!--Page Header-->
    <!-- /Header -->

    <!--Page Header-->
    <section class="page-header profile_page">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1>My Booking</h1>
          </div>
          <ul class="coustom-breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>My Booking</li>
          </ul>
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <?php
    $useremail = $_SESSION['login'];
    $sql = "SELECT * from tblusers where EmailId=:useremail ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $result) { ?>
        <section class="user_profile inner_pages">
          <div class="container">
            <div class="user_profile_info gray-bg padding_4x4_40">
              <div class="upload_user_logo"> <img src="assets/images/dealer-logo.jpg" alt="image">
              </div>

              <div class="dealer_info">
                <h5><?php echo htmlentities($result->FullName); ?></h5>
                <p><?php echo htmlentities($result->Address); ?><br>
                  <?php echo htmlentities($result->City); ?>&nbsp;<?php echo htmlentities($result->Country);
      }
    } ?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3">
            <?php include ('includes/sidebar.php'); ?>

            <div class="col-md-8 col-sm-8">
              <div class="profile_wrap">
                <h5 class="uppercase underline">My Booikngs </h5>
                <div class="my_vehicles_list">
                  <ul class="vehicle_listing">
                    <?php
                    $useremail = $_SESSION['login'];
                    $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblvehicles.PricePerDay,DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totaldays,tblbooking.BookingNumber,tblbooking.VehicleId  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail order by tblbooking.id desc";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;



                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {
                        $BN = htmlentities($result->BookingNumber);

                        $vid = htmlentities($result->VehicleId);


                        echo "<p style='font-size: 20px;'>Vehicle ID: <span style='color: red;'>" . $vid . "</span></p>";



                        ?>

                        <?php
                        //=======================Testing===========================================
                        // SQL to fetch all records from tblbooking
                        include ('includes/config.php');
                        //$sql = "SELECT * FROM tblbooking";
                        // Prepare and execute the SQL query
                        $query = $dbh->prepare("SELECT status FROM tblbooking WHERE BookingNumber = :BN");
                        $query->bindParam(':BN', $BN, PDO::PARAM_STR);
                        $query->execute();

                        // Fetch all results
                        $results = $query->fetchAll(PDO::FETCH_ASSOC);
                        if (count($results) > 0) {



                          // Output data of each row
                          foreach ($results as $row) {
                            $status = htmlspecialchars($row['status']);
                            //echo $status;
                          }

                        }
                        ?>
                        <!-- ============================/Testing====================================== -->
                        <li>
                          <h4 style="color:red">Booking No #<?php echo htmlentities($result->BookingNumber); ?></h4>
                          <div class="vehicle_img"> <a
                              href="vehical-details.php?vhid=<?php echo htmlentities($result->vid); ?>"><img
                                src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" alt="image"></a>
                          </div>
                          <div class="vehicle_title">

                            <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid); ?>">
                                <?php echo htmlentities($result->BrandName); ?> ,
                                <?php echo htmlentities($result->VehiclesTitle); ?></a></h6>
                            <p><b>From </b> <?php echo htmlentities($result->FromDate); ?> <b>To </b>
                              <?php echo htmlentities($result->ToDate); ?></p>
                            <div style="float: left">
                              <p><b>Message:</b> <?php echo htmlentities($result->message); ?> </p>
                            </div>
                          </div>
                          <?php if ($result->Status == 1) { ?>
                            <div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                              <div class="clearfix"></div>
                            </div>

                          <?php } else { ?>
                            <div style="margin-top: 20px;" class="vehicle_status">
                              <button class="updateStatusButton btn outline btn-xs" data-bn="<?php echo $BN; ?>">Not Confirm
                                yet</button>
                              <div class="clearfix"></div>
                            </div>

                            <script>
                              document.querySelectorAll('.updateStatusButton').forEach(function (button) {
                                button.addEventListener('click', function (event) {
                                  var BN = this.getAttribute('data-bn');  // Get the booking number from the data attribute

                                  // Check if the button has not been confirmed yet using a data attribute
                                  if (!this.dataset.isConfirmed) {
                                    var confirmAction = confirm("Do you want to confirm the order with order number of " + BN + "?");

                                    if (confirmAction) {
                                      this.dataset.isConfirmed = 'true';

                                      var xhr = new XMLHttpRequest();
                                      xhr.open("POST", "update_order.php", true);
                                      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                      xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                          window.location.reload(); // Optionally reload the page to reflect changes
                                        }
                                      };
                                      xhr.send('BN=' + encodeURIComponent(BN));
                                    } else {
                                      event.preventDefault();
                                    }
                                  }
                                });
                              });
                            </script>

                          <?php } { ?>
                            <div style="margin-top: 20px;" class="vehicle_status">
                              <a href="#" class="btn outline btn-xs"
                                onclick="cancelOrder(event, '<?php echo $BN; ?>', '<?php echo $vid; ?>')">Cancel</a>
                              <div class="clearfix"></div>
                            </div>

                            <script>
                              function cancelOrder(event, bookingNumber, vid) {
                                event.preventDefault(); // Prevent the default anchor behavior
                                if (!confirm('Are you sure you want to cancel this order?')) return; // Confirmation dialog

                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "delete_order.php", true);
                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function () {
                                  if (xhr.readyState === 4 && xhr.status === 200) {
                                    alert(xhr.responseText); // Display response from server
                                    if (xhr.responseText.includes("successfully")) {
                                      window.location.href = 'index.php'; // Redirect to index.php
                                    }
                                  }
                                };
                                xhr.send("BN=" + encodeURIComponent(bookingNumber) + "&vid=" + encodeURIComponent(vid));
                              }
                            </script>


                          <?php } ?>

                        </li>

                        <h5 style="color:blue">Invoice</h5>

                        <table>
                          <tr>
                            <th>Car Name</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Total Days</th>
                            <th>Rent / Day</th>
                          </tr>
                          <tr>
                            <td><?php echo htmlentities($result->VehiclesTitle); ?>,
                              <?php echo htmlentities($result->BrandName); ?>
                            </td>
                            <!-- ================================Edit Date========================================================== -->
                            <!-- <td><?php echo htmlentities($result->FromDate); ?></td>
                            <td> <?php echo htmlentities($result->ToDate); ?></td> -->
                            <?php
                            $fromDate = htmlentities($result->FromDate);
                            $toDate = htmlentities($result->ToDate);
                            $bookingId = $result->BookingNumber;
                            ?>
                            <td>
                              <span id="fromDateDisplay-<?= $bookingId ?>"><?= $fromDate ?></span>
                              <input type="date" id="fromDateInput-<?= $bookingId ?>" value="<?= $fromDate ?>"
                                style="display:none;">
                            </td>
                            <td>
                              <span id="toDateDisplay-<?= $bookingId ?>"><?= $toDate ?></span>
                              <input type="date" id="toDateInput-<?= $bookingId ?>" value="<?= $toDate ?>"
                                style="display:none;">
                            </td>


                            <!-- ======================================================================================= -->
                            <td><?php echo htmlentities($tds = $result->totaldays); ?></td>
                            <td> <?php echo htmlentities($ppd = $result->PricePerDay); ?></td>
                          </tr>
                          <tr>
                            <th colspan="4" style="text-align:center;"> Grand Total</th>
                            <th><?php echo htmlentities($tds * $ppd); ?></th>
                          </tr>
                          <!-- ============================================================================================ -->
                          <tr>
                            <td colspan="5" style="text-align: center;">
                              <button id="editButton-<?= $bookingId ?>" onclick="editDates(<?= $bookingId ?>)"
                                style="padding: 10px 20px; margin: 5px; border-radius: 4px; background-color: #007BFF; color: white; border: none; cursor: pointer; transition: background-color 0.3s;">
                                Edit Date
                              </button>
                              <button id="saveButton-<?= $bookingId ?>" onclick="saveDates(<?= $bookingId ?>)"
                                style="display:none; padding: 10px 20px; margin: 5px; border-radius: 4px; background-color: #28a745; color: white; border: none; cursor: pointer; transition: background-color 0.3s;">
                                Save Date
                              </button>
                              <button id="cancelButton-<?= $bookingId ?>" onclick="cancelEdit(<?= $bookingId ?>)"
                                style="display:none; padding: 10px 20px; margin: 5px; border-radius: 4px; background-color: #dc3545; color: white; border: none; cursor: pointer; transition: background-color 0.3s;">
                                Cancel Edit
                              </button>
                            </td>
                          </tr>
                        </table>

                        <script>
                          function editDates(bookingId) {
                            document.getElementById('fromDateDisplay-' + bookingId).style.display = 'none';
                            document.getElementById('toDateDisplay-' + bookingId).style.display = 'none';
                            document.getElementById('fromDateInput-' + bookingId).style.display = 'inline';
                            document.getElementById('toDateInput-' + bookingId).style.display = 'inline';
                            document.getElementById('editButton-' + bookingId).style.display = 'none';
                            document.getElementById('saveButton-' + bookingId).style.display = 'inline';
                            document.getElementById('cancelButton-' + bookingId).style.display = 'inline';
                          }

                          function cancelEdit(bookingId) {
                            document.getElementById('fromDateDisplay-' + bookingId).style.display = 'inline';
                            document.getElementById('toDateDisplay-' + bookingId).style.display = 'inline';
                            document.getElementById('fromDateInput-' + bookingId).style.display = 'none';
                            document.getElementById('toDateInput-' + bookingId).style.display = 'none';
                            document.getElementById('editButton-' + bookingId).style.display = 'inline';
                            document.getElementById('saveButton-' + bookingId).style.display = 'none';
                            document.getElementById('cancelButton-' + bookingId).style.display = 'none';
                          }

                          function saveDates(bookingId) {
                            var fromDate = document.getElementById('fromDateInput-' + bookingId).value;
                            var toDate = document.getElementById('toDateInput-' + bookingId).value;


                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "update_dates.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                              if (xhr.readyState === 4 && xhr.status === 200) {
                                alert('Dates updated successfully!');
                                location.reload(); // Refresh the page to show updated dates
                              }
                            };
                            xhr.send("bookingId=" + encodeURIComponent(bookingId) + "&fromDate=" + encodeURIComponent(fromDate) + "&toDate=" + encodeURIComponent(toDate));
                          }
                        </script>

                        <!-- ============================================================================================================= -->


                        <hr />
                      <?php }
                    } else { ?>
                      <h5 align="center" style="color:red">No booking yet</h5>
                    <?php } ?>


                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <!--/my-vehicles-->
    <?php include ('includes/footer.php'); ?>

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
<?php } ?>