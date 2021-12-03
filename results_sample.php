<?php 
// Start Session
session_start();

//Include Config File
require_once "config.php";

$lat = NULL;
$lon = NULL;
$rating = NULL;
$locations = array();
$distance = 0;

if (isset($_GET['lat']) && isset($_GET['lon'])) {
  $lat = $_GET['lat'];
  $lon = $_GET['lon'];
} elseif (isset($_GET['rating'])) {
  $rating = $_GET['rating'];
} else {
  // default case in order to display data if by accident someone reaches the url
  // and no GET parameters were given
  $rating = "3";
}

if (isset($lat) && isset($lon)) {
  // SQL query to sort parks in order of distance
  $sql = "
    SELECT 
      id, 
      name,
      address,
      city,
      province, 
      avgrating, 
      latitude,
      longitude,
      (3959 * acos( cos(radians($lat))* cos(radians(latitude))* cos(radians(longitude) - radians($lon))+ sin(radians($lat))* sin(radians(latitude))))
      AS 
        distance
    FROM
      parks_info
    HAVING
      distance < 200
    ORDER BY
      distance
    LIMIT 0,20";
  $stmt = $pdo->prepare($sql);
  if ($stmt && $stmt->execute()) {
    if ($stmt->rowCount() > 0) {
      $locations = $stmt->fetchAll();
    } else {
      echo "No parks within a 200km radius";
    }
  } else {
    echo "Unable to retrieve closest parks";
  }

  unset($stmt);
} elseif(isset($rating)) {
    $sql = "
      SELECT 
        id, 
        name,
        address,
        city,
        province, 
        avgrating, 
        latitude,
        longitude
      FROM
        parks_info
      HAVING
        avgrating >= $rating
      ORDER BY
        avgrating DESC
      LIMIT 0,20";
    $stmt = $pdo->prepare($sql);
    if ($stmt && $stmt->execute()) {
      if ($stmt->rowCount() > 0) {
        $locations = $stmt->fetchAll();
      } else {
        echo "No parks that meet the rating requirement";
      }
    }

    unset($stmt);
  } else {
  echo "Something Went Wrong";
}

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
    <?php 
      if(isset($lat) && isset($lon)) {
        echo "<input type=\"hidden\" name=\"lat\" id=\"lat\" value=$lat>";
        echo "<input type=\"hidden\" name=\"lon\" id=\"lon\" value=$lon>";
      }
    ?>
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
          <?php for ($index = 0; $index < count($locations); $index++) { ?>
              <tr>
                <?php
                  if(isset($lat) && isset($lon)) {
                    $distance = number_format($locations[$index]["distance"], 2);
                  } else {
                    $distance = 0.0;
                  }
                  
                  $name = $locations[$index]["name"];
                  $avgrating = number_format($locations[$index]["avgrating"], 2);
                  $parkid = $locations[$index]["id"];
                  $address = $locations[$index]["address"].", ".$locations[$index]["city"].", ".$locations[$index]["province"];
                  $parkLat = $locations[$index]["latitude"];
                  $parkLon = $locations[$index]["longitude"];

                  if($distance > 0) {
                    echo "<td class=\"distance-cell\">$distance</td>";
                  } else {
                    echo "<td class=\"distance-cell\">-</td>";
                  }
                  echo "<td>$name</td>";
                  echo "<td>$avgrating/5</td>";
                  echo "<td class=\"table-btn-cell\"><a id=\"$parkid\" name=\"$name\" latitude=\"$parkLat\" longitude=\"$parkLon\" address=\"$address\" distance=\"$distance\" href=\"object_page.php?parkid=$parkid\" class=\"btn btn-primary row-link\">Find</a></td>"
                ?>
              </tr>
          <?php } ?>
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