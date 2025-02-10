<header>
  <style>
    #header-search-form input[type="text"] {
      transition: all 0.3s ease;
      color: #333;
      box-shadow: none;
    }

    #header-search-form input[type="text"]:focus {
      color: #000;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      /* subtle shadow to highlight */
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#search').keyup(function () {
        var query = $(this).val();
        if (query !== '') {
          $.ajax({
            url: "suggest.php",
            method: "POST",
            data: { query: query },
            success: function (data) {
              $('#suggestion-box').fadeIn();
              $('#suggestion-box').html(data);
            }
          });
        }
      });
    });
  </script>

  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img src="assets/images/logo.png" alt="image" /></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <?php
            $sql = "SELECT EmailId,ContactNo from tblcontactusinfo";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
              $email = $result->EmailId;
              $contactno = $result->ContactNo;
            }
            ?>

            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:<?php echo htmlentities($email); ?>"><?php echo htmlentities($email); ?></a>
            </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Service Helpline Call Us: </p>
              <a href="tel:<?php echo htmlentities($contactno); ?>"><?php echo htmlentities($contactno); ?></a>
            </div>
            <div class="social-follow">

            </div>
            <?php if (strlen($_SESSION['login']) == 0) {
              ?>
              <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal"
                  data-dismiss="modal">Login / Register</a> </div>
            <?php } else {

              echo "Welcome To Car rental portal";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse"
          class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span
            class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                  class="fa fa-user-circle" aria-hidden="true"></i>
                <?php
                $email = $_SESSION['login'];
                $sql = "SELECT FullName FROM tblusers WHERE EmailId=:email ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {

                    echo htmlentities($result->FullName);
                  }
                } ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
                <?php if ($_SESSION['login']) { ?>
                  <li><a href="profile.php">Profile Settings</a></li>
                  <li><a href="update-password.php">Update Password</a></li>
                  <li><a href="my-booking.php">My Reservation</a></li>
                  <li><a href="post-testimonial.php">Post a Testimonial</a></li>
                  <li><a href="my-testimonials.php">My Testimonial</a></li>
                  <?php if ($email == "admin@gmail.com") { ?>
                    <li><a href="update_cars.php">Update Car Information</a></li>
                  <?php } ?>
                  <li><a href="logout.php">Sign Out</a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a> </li>
            <!-- =============================my-booking.php if not logged in show a page if logged in show another=============================================== -->
            <!-- <li><a href="my-booking.php?type=aboutus">Reservation</a></li>	  -->
            <?php if (strlen($_SESSION['login']) != 0): ?>
              <li><a href="my-booking.php">Reservation</a></li>
            <?php else: ?>
              <li><a href="Bookings.php?type=aboutus">Reservation</a></li>
            <?php endif; ?>

            <!-- <li><a href="car-listing.php">Car Listing</a> -->
            <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Choose Car By Brand <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="redirectToProcess('1'); return false;">Maruti Suzuki</a></li>
                <li><a href="#" onclick="redirectToProcess('2'); return false;">BMW</a></li>
                <li><a href="#" onclick="redirectToProcess('3'); return false;">Audi</a></li>
                <li><a href="#" onclick="redirectToProcess('4'); return false;">Nissan</a></li>
                <li><a href="#" onclick="redirectToProcess('5'); return false;">Toyota</a></li>
                <li><a href="#" onclick="redirectToProcess('8'); return false;">Chrysler</a></li>
                <li><a href="#" onclick="redirectToProcess('0'); return false;">See All</a></li>
            </ul>
          </li> -->

            <script>
              function redirectToProcess(value) {
                if (value) {
                  sessionStorage.setItem('buttonValue', value); // Set the selected value in session storage
                  window.location.href = 'car-listing.php?carType=' + encodeURIComponent(value); // Redirect with the value
                }
              }
            </script>


            <li><a href="page.php?type=aboutus">About Us</a></li>

            <li><a href="page.php?type=faqs">FAQs</a></li>
            <li><a href="contact-us.php">Contact Us</a></li>

          </ul>
        </div>
      </div>
  </nav>
  <!-- Navigation end -->

</header>