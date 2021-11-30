<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- importing style sheets, ours and bootstrap's -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/signup.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <!-- meta tags specifying charset, and user visible area -->
    <meta charset="utf-8">
    <title>Paw Go - Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
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
                <a class="nav-link" aria-current="page" href="index.html">Home</a>
              </li>
              <li class="nav-item flex-fill">
                <a class="nav-link" href="results_sample.html">Results</a>
              </li>
              <li class="nav-item flex-fill">
                <a class="nav-link" href="submit_object.html">Submit Park</a>
              </li>
              <li class="nav-item flex-fill">
                <!-- div container which pairs the profile icon with the Login/Register menu item to gear users towards our signup page -->
                <div class="profile">
                  <img class="profile-icon" src="images/user.png" alt="User/Profile icon">
                  <!-- Set as the active link as we are currently on this page -->
                  <a class="nav-link active" href="user_registration.html">Login / Register</a>
                </div>
              </li>
            </ul>
            <!-- Contains the search bar at the top which allows users to search for park locations across all of our pages -->
            <!-- Once the user clicks the search button within the navbar it redirects you to the results page -->
            <form class="d-flex flex-fill" action="results_sample.html">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-warning" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view">
      <!-- Title of view, shows user they are at User Registration Page -->
      <h2 class="signup-title">Sign Up for Access!</h2>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container">
        <!-- Signup Page Form Element to record user's signup request -->
        <form class="signup-form" id="signup-form" action="./index.html" onsubmit="return validate()">
          <!-- Container to allow for different view on desktop vs mobile -->
          <div class="form-row multi-input-row">
            <!-- Email HTML5 Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="email-input">Email</label>
              <input type="text" class="form-control" id="email-input" placeholder="email@gmail.com">
            </div>
            <!-- Password HTML5 Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="password-input">Password</label>
              <input type="password" class="form-control" id="password-input" placeholder="**********">
            </div>
          </div>
          <!-- Address HTML5 Field for signup -->
          <div class="form-group form-field">
            <label class="label-field" for="address-input">Address</label>
            <input type="text" class="form-control" id="address-input" placeholder="1234 Main St">
          </div>
          <!-- Phone Number HTML5 Field for signup -->
          <div class="form-row multi-input-row">
            <div class="form-group form-field">
              <label class="label-field" for="tel-input">Phone Number</label>
              <input type="text" class="form-control" id="tel-input" placeholder="905-905-9050">
            </div>
            <!-- Province Selection Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="province-input">Province</label>
              <select id="province-input" class="form-control">
                <option selected>Select</option>
                <option>Ontario</option>
                <option>British Columbia</option>
                <option>Quebec</option>
                <option>Saskatchewan</option>
                <option>P.E.I</option>
                <option>Nova Scotia</option>
                <option>New Brunswick</option>
                <option>Alberta</option>
                <option>Newfoundland & Labrador</option>
                <option>Manitoba</option>
                <option>Yukon</option>
                <option>Northwest Territories</option>
                <option>Nunavut</option>
              </select>
            </div>
            <!-- Date HTML5 Field for signup (Date of Birth) -->
            <div class="form-group form-field">
              <label class="label-field" for="dob-input">Date of Birth</label>
              <input type="date" class="form-control" id="dob-input">
            </div>
          </div>
        </form>
        <!-- Submit button linked to Form Element above, For Assignment 1 this leads back to Home Page -->
        <button type="submit" form="signup-form" id="submit-signup-form" class="btn btn-primary">Sign Up</button>
      </div>
    </div>
    <!-- Page footer containing copyright and navigation links to all of our main pages -->
    <!-- Py and Px involve spacing vertically and horizontally respectively, justify center keeps the content centered -->
    <!-- text-muted gives the footer text that grey look -->
    <footer class="py-3">
      <ul class="nav justify-content-center border-bottom pb-2 mb-3">
        <li class="nav-item">
          <a href="index.html" class="nav-link px-2 text-muted">Home</a>
        </li>
        <li class="nav-item">
          <a href="results_sample.html" class="nav-link px-2 text-muted">Results</a>
        </li>
        <li class="nav-item">
          <a href="submit_object.html" class="nav-link px-2 text-muted">Submit Park</a>
        </li>
        <li class="nav-item">
          <a href="user_registration.html" class="nav-link px-2 text-muted">Login/Register</a>
        </li>
      </ul>
      <p class="text-center text-muted">&copy; Copyright 2021, Paw Go. All  Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="scripts/form_validation.js"></script>
  </body>
</html>