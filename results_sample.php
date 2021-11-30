<?php 
// Start Session
session_start();
?>

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
      <?php include 'components/nav_menu.inc' ?>
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
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">30.2 km</td>
            <td>Oshawa Dog Park</td>
            <td>3.7/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">5.2 km</td>
            <td>Burlington Dog Park</td>
            <td>3.8/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">15.5 km</td>
            <td>Milton Dog Park</td>
            <td>3.9/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">1.5 km</td>
            <td>Oakville Dog Park</td>
            <td>4.0/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">10.2 km</td>
            <td>Mississauga Dog Park</td>
            <td>4.1/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">24.7 km</td>
            <td>Brampton Dog Park</td>
            <td>4.2/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">20.0 km</td>
            <td>Hamilton Dog Park</td>
            <td>4.3/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">42.8 km</td>
            <td>Markham Dog Park</td>
            <td>4.4/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">100.2 km</td>
            <td>Orangeville Dog Park</td>
            <td>4.5/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
          <tr>
            <td class="distance-cell">85.9 km</td>
            <td>Vaughan Dog Park</td>
            <td>4.6/5</td>
            <td class="table-btn-cell"><a href="object_page.php" class="btn btn-primary row-link">Find</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Page footer containing copyright and navigation links to all of our main pages -->
    <!-- Py and Px involve spacing vertically and horizontally respectively, justify center keeps the content centered -->
    <!-- text-muted gives the footer text that grey look -->
    <footer class="py-3">
      <?php include 'components/footer.inc' ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="./scripts/map_results_page.js"></script>
  </body>
</html>