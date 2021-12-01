
<!-- Bootstrap 5 navbar setup for a navbar that sticks to the top and is also responsive with screen resizing -->
      <!-- Hamburger menu appears when the screen width reaches a certain limit, hence the button with class navbar-toggler -->
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <!-- Website logo image pinned to the left of the navbar across all pages -->
          <img class="dog-paw-icon" src="images/dog-paw-icon.png" alt="Dog Paw Icon">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Justify-content-center so that our navbar menu items start with a center orientation and are then able to be spaced out from that reference point -->
          <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <!-- Flex-fill allows for each menu item including the menu to be equally spaced out from one another -->
            <ul class="navbar-nav flex-fill">
              <li class="nav-item flex-fill">
                <!-- Set as the active link as we are currently on this page -->
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item flex-fill">
                <a class="nav-link" href="results_sample.php">Results</a>
              </li>
              <li class="nav-item flex-fill">
                <a class="nav-link" href="submit_object.php">Submit Park</a>
              </li>
              <li class="nav-item flex-fill">
                <!-- div container which pairs the profile icon with the Login/Register menu item to gear users towards our signup page -->
                <div class="profile">
                  <img class="profile-icon" src="images/user.png" alt="User/Profile icon">
                  <?php
                    // If the User is currently logged in, we show the Profile page otherwise we show the Login Page
                    if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
                      echo "<a class=\"nav-link\" href=\"user_profile.php\">Profile</a>";
                    } else {
                      echo "<a class=\"nav-link\" href=\"user_login.php\">Login</a>";
                    }
                  ?>
                </div>
              </li>
              <?php
                    // If the User is currently logged in, we show the Profile page otherwise we show the Login Page
                    if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
                      echo "<a class=\"nav-link\" href=\"user_logout.php\">Logout</a>";
                    } else {
                      echo "<a class=\"nav-link\" href=\"user_registration.php\">Register</a>";
                    }
              ?>
            </ul>
            <?php if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) { ?>
              <div class="modal fade" id="logoutmodal" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Logout Confirmation</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you would like to Logout?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="user_logout.php" class="btn btn-primary">Logout</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- Contains the search bar at the top which allows users to search for park locations across all of our pages -->
            <!-- Once the user clicks the search button within the navbar it redirects you to the results page -->
            <form class="d-flex flex-fill" action="results_sample.php">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-warning" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>