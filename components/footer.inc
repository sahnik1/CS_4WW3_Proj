<ul class="nav justify-content-center border-bottom pb-2 mb-3">
    <li class="nav-item">
      <a href="index.php" class="nav-link px-2 text-muted">Home</a>
    </li>
    <li class="nav-item">
      <a href="results_sample.php" class="nav-link px-2 text-muted">Results</a>
    </li>
    <li class="nav-item">
      <a href="submit_object.php" class="nav-link px-2 text-muted">Submit Park</a>
    </li>
    <li class="nav-item">
      <?php
      // If the User is currently logged in, we show the Profile page otherwise we show the Login Page
      if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) {
        echo "<a href=\"user_profile.php\" class=\"nav-link px-2 text-muted\">Profile</a>";
      } else {
        echo "<a href=\"user_registration.php\" class=\"nav-link px-2 text-muted\">Register</a>";
      }
      ?>
    </li>
</ul>
<p class="text-center text-muted">&copy; Copyright 2021, Paw Go. All  Rights Reserved</p>