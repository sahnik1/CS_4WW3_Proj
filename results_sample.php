<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- meta tags specifying charset, and user visible area -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paw Go - Results</title>
    <!-- importing style sheets, ours and bootstrap's -->
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/results.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
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
              <!-- Set as the active link as we are currently on this page -->
              <li class="nav-item flex-fill">
                <a class="nav-link active" href="results_sample.html">Results</a>
              </li>
              <li class="nav-item flex-fill">
                <a class="nav-link" href="submit_object.html">Submit Park</a>
              </li>
              <li class="nav-item flex-fill">
                <!-- div container which pairs the profile icon with the Login/Register menu item to gear users towards our signup page -->
                <div class="profile">
                  <img class="profile-icon" src="images/user.png" alt="User/Profile icon">
                  <a class="nav-link" href="user_registration.html">Login / Register</a>
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
    <!-- Container for the map that is centered vertically in the page view, contains the user's location centered in the map view -->
    <!-- while highlighting all of the dog parks near the user using a custom indicator -->
    <div class="map-container text-center">
      <div id="Results-Map">
      </div>
    </div>
    <!-- Table containing the main details of the closest dog parks to the user, they will be able to sort by distance/rating/park name in the future with Javascript -->
    <div class="table-container">
      <!-- Table-hover allows users on desktop to know which table they are mousing over -->
      <table class="table table-hover">
        <thead>
          <tr class="table-dark">
            <th scope="col">Distance</th>
            <th scope="col">Name</th>
            <th scope="col">Rating</th>
            <th scope="col">Directions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Each table row contains an anchor tag behaving as a button, in order to redirect users to that specific object's page -->
          <tr>
            <td class="distance-cell">28.1 km</td>
            <td>Ajax Dog Park</td>
            <td>3.6/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">30.2 km</td>
            <td>Oshawa Dog Park</td>
            <td>3.7/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">5.2 km</td>
            <td>Burlington Dog Park</td>
            <td>3.8/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">15.5 km</td>
            <td>Milton Dog Park</td>
            <td>3.9/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">1.5 km</td>
            <td>Oakville Dog Park</td>
            <td>4.0/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">10.2 km</td>
            <td>Mississauga Dog Park</td>
            <td>4.1/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">24.7 km</td>
            <td>Brampton Dog Park</td>
            <td>4.2/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">20.0 km</td>
            <td>Hamilton Dog Park</td>
            <td>4.3/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">42.8 km</td>
            <td>Markham Dog Park</td>
            <td>4.4/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">100.2 km</td>
            <td>Orangeville Dog Park</td>
            <td>4.5/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">85.9 km</td>
            <td>Vaughan Dog Park</td>
            <td>4.6/5</td>
            <td class="table-btn-cell"><a href="object_page.html" class="btn btn-primary row-link">Find</a></td>
          </tr>
        </tbody>
      </table>
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
    <script src="./scripts/map_results_page.js"></script>
  </body>
</html>