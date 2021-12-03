<?php
// Start Session
session_start();

// Include Config File
require_once "config.php";
// Include S3 Config File
require_once "upload-to-s3.php";

$parkid = $_GET["parkid"];
$results = array();

$rev_title_err = "";
$rev_title = "";
$rev_descr_err = "";
$rev_descr = "";

// Handling a review submission
if ($_SERVER["REQUEST_METHOD"] == "POST"){

  // Ttle Server Side Validation
  if (empty(trim($_POST["title"]))){
    $rev_title_err = "Please Enter a Title for the review";
  } else{
    $rev_title = trim($_POST["title"]);
  }

  // Description Server Side Validation
  if (empty(trim($_POST["description"]))){
    $rev_descr_err = "Please Enter a Description for the review";
  } else{
    $rev_descr = trim($_POST["description"]);
  }

  if (empty($rev_title_err) && empty($rev_descr_err)){
    // SQL Template to upload review
    $sql = "INSERT INTO reviews (parkid, userid, title, description, rating) VALUES (:id, :userid, :title, :descr, :rating)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt){
      // Bind the vars to the statement
      $stmt->bindParam(":id", $param_parkid, PDO::PARAM_INT);
      $param_parkid = intval($parkid);

      $stmt->bindParam(":userid", $param_userid);
      $param_userid = $_SESSION["id"];

      $stmt->bindParam(":title", $param_title);
      $param_title = $rev_title;

      $stmt->bindParam(":descr", $param_descr);
      $param_descr = $rev_descr;

      $stmt->bindParam(":rating", $param_rating);
      $param_rating = intval($_POST["rating-val"]);

      if ($stmt->execute()){

        // Now we update the average rating for the park associated with the review
        $sql = "SELECT AVG(rating) as average from reviews WHERE parkid = :parkid";
        $stmt = $pdo->prepare($sql);
        if ($stmt){
          $stmt->bindParam(":parkid", $param_parkid, PDO::PARAM_INT);
          $param_parkid = intval($parkid);
          if ($stmt->execute()){
            if ($stmt->rowCount() == 1){
              $row = $stmt->fetch();
              if ($row){
                $average = $row["average"];
                 
                // Now we update this avg rating in the parks_info table
                $sql = "UPDATE parks_info SET avgrating = :avg WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                if($stmt){
                  $stmt->bindParam(":id", $param_parkid, PDO::PARAM_INT);
                  $param_parkid = intval($parkid);

                  $stmt->bindParam(":avg", $param_average);
                  $param_average = intval($average);

                  $stmt->execute();
                }
              }
            }
          }
        }

        // User Review Saved in DB, Therefore we redirect back to original page
        header("location: object_page.php?parkid=".$parkid);
      } else {
        echo "Something Went Wrong";
      }

      unset($stmt);
    }
  }
}

// If ParkID set, carry out other necessary retrieval actions
if (isset($parkid)){
  // SQL Template to retrieve park info and reviews
  $sql = "SELECT name, puppies, description, address, city, province, avgrating, latitude, longitude from parks_info WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  if ($stmt){
    // Bind the var to the statement
    $stmt->bindParam(":id", $param_parkid, PDO::PARAM_INT);
    $param_parkid = intval($parkid);
    // Now we retrieve the park's general info
    if ($stmt->execute()){
      // Check that we have ONLY one park with this id
      if ($stmt->rowCount() == 1){
        $row = $stmt->fetch();
        if ($row){
          $results["name"] = $row["name"];
          $results["puppies"] = $row["puppies"];
          $results["description"] = $row["description"];
          $results["address"] = $row["address"];
          $results["city"] = $row["city"];
          $results["province"] = $row["province"];
          $results["avg"] = $row["avgrating"];
          $results["lat"] = floatval($row["latitude"]);
          $results["lon"] = floatval($row["longitude"]);
          $results["reviews"] = array();

          $sql = "SELECT B.name as fullname, A.title as title, A.description as description, A.rating as rating from reviews A, users B WHERE parkid = :id AND A.userid = B.id";
          $stmt = $pdo->prepare($sql);
          if ($stmt){
            $stmt->bindParam(":id", $param_parkid, PDO::PARAM_INT);
            $param_parkid = intval($parkid);
            if ($stmt->execute()){
              if ($stmt->rowCount() > 0){
                $row = $stmt->fetchAll();
                if ($row){
                  $results["reviews"] = $row;
                }
              }
            }
          }
        }
      }
    }
  }

  // Command for getting the image associated with the park id
  $cmd = $s3Client->getCommand('GetObject', [
    'Bucket' => 'paw-go-park-images',
    'Key' => $parkid
  ]);

  // Request for creating presigned url for viewing image
  $request = $s3Client->createPresignedRequest($cmd, '+60 minutes');

  // Get the actual presigned-url
  $results["imageurl"] = (string)$request->getUri();

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- importing style sheets, ours and bootstrap's -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/parkview.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <!-- meta tags specifying charset, and user visible area -->
    <meta charset="utf-8">
    <?php echo "<title>".$results["name"]."</title>"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
  </head>
  <body>
    <header>
      <?php include 'components/nav_menu.inc' ?>
    </header>
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view">
      <!-- Title of view, shows which park information currently looking at -->
      <h2 class="park-title"><?php echo $results["name"];?></h2>
      <!-- Container for resizing the dog park image for mobile/desktop -->
      <div class="park-img-container">
        <img class="park-img" src="<?php echo $results["imageurl"]; ?>" alt="Dog Park Picture">
      </div>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container">
        <!-- Tabbed navs for switching between content related to the dog park -->
        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link <?php if (empty($rev_title_err) && empty($rev_descr_err)){echo "active";} ?>" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Information</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-selected="false">Reviews</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link <?php if (!empty($rev_title_err) || !empty($rev_descr_err)){echo "active";} ?>" id="submit-reviews-tab" data-bs-toggle="tab" data-bs-target="#submit-reviews" type="button" role="tab" aria-selected="false">Submit Review</button>
          </li>
        </ul>
        <!-- This container is referred to by the tab that is selected above -->
        <div class="tab-content">
            <!-- This shows that the current tab content is active and therefore displayed -->
          <div class="tab-pane fade <?php if (empty($rev_title_err) && empty($rev_descr_err)){echo "show active";} ?>" id="description" role="tabpanel" aria-labelledby="description-tab">
              <!-- Using Bootstrap Card element here to encompass the park details and map, also allows responsive design -->
            <div class="card">
              <div class="card-body">
                  <!-- Inner container to separat block of text from the map image -->
                <div class="inner-card-container">
                  <!-- Dog Park Title as shown in Description -->
                  <h4 class="card-title"><?php echo $results["name"]; ?></h4>
                  <br>
                  <!-- Dog Park Address as shown in Description -->
                  <h5 class="card-subtitle mb-2 text-muted"><?php echo $results["address"]; ?></h5>
                  <br>
                  <!-- Span element to show inline the average rating using star icons in Bootstrap -->
                  <span>
                  Average Rating:
                  <?php for ($star = 0;$star < $results["avg"]; $star++) {?>
                    <i class="bi bi-star-fill"></i>
                  <?php } ?>
                  <?php for ($star = 5 - $results["avg"];$star > 0; $star--) {?>
                    <i class="bi bi-star"></i>
                  <?php } ?>
                  </span>
                  <br>
                </div>
                  <!-- Container to separate the map from the text and allow responsive resizing -->
                  <div class="map-container">
                    <div id="Park-Map" >

                      <script>
                        // Main instantiation for the Map, Park-Map is the div we target to place the map in
                        var map = L.map( 'Park-Map', {
                          // Center is the focal point of the map for the default view on load
                          // These Long/Lat refer to central Oakville
                          center: [<?php echo $results["lat"].", ".$results["lon"]?>],
                          minZoom: 2,
                          // This is a Cities level Zoom, enough to see neighboring cities
                          zoom: 9
                        });


                        L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                          subdomains: ['a','b','c']
                        }).addTo( map );

                        // Custom Icon for 'Paw' print marker, credit goes to Google Earth (although I dont think they care)
                        var pawIcon = L.icon({
                          iconUrl: 'https://www.gstatic.com/earth/images/stockicons/190201-2016-animal-paw_4x.png',
                          iconSize: [64, 64], // size of the icon
                        });

                        // Custom Marker, Shows the location of Oakville Dog Park (Imaginary),
                        // shows popup when clicked which contains a link to the object page as well as the Park's Address

                        var popup = "<?php echo "<center><a href='".htmlspecialchars($_SERVER["PHP_SELF"])."?parkid=".$parkid."'><b>".$results["name"]."</b></a></center><p>Address: ".$results["address"]."</p>"; ?>";

                        L.marker([<?php echo $results["lat"].", ".$results["lon"]?>], {icon: pawIcon}).addTo(map).bindPopup(popup);

                      </script>

                    </div>
                  </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="ratings-tab">
            <!-- Each Review is put inside its own Card -->
            <!-- Each of these cards are then turned into flex containers on desktop -->
            <div id="ratings">

              <?php 
                if (count($results["reviews"]) < 0){

                } else {
                  for ($index = 0;$index < count($results["reviews"]); $index++) { ?>
                    <div class="card park-reviews">
                      <div class="card-body review">
                        <?php echo "<h6 class=\"card-title\">".$results["reviews"][$index]["title"]."</h6>";
                              echo "<p class=\"card-subtitle mb-2 text-muted\">".$results["reviews"][$index]["fullname"]."</p>";
                              $rating_val = intval($results["reviews"][$index]["rating"]) ?>
                        <div class="rating-container">
                          <?php for ($star = 0;$star < $rating_val; $star++) {?>
                          <i class="bi bi-star-fill"></i>
                          <?php } ?>
                          <?php for ($star = 5 - $rating_val;$star > 0; $star--) {?>
                          <i class="bi bi-star"></i>
                          <?php } ?>
                        </div>
                        <?php echo "<p class=\"description\">".$results["reviews"][$index]["description"]."</p>" ?>
                      </div>
                    </div>
                <?php }
                } 
                ?>
            </div>
          </div>
          
          <div class="tab-pane fade <?php if (!empty($rev_title_err) || !empty($rev_descr_err)){echo "show active";} ?>" id="submit-reviews" role="tabpanel" aria-labelledby="submit-reviews-tab">
            <!-- Using Bootstrap Card element for body of the form and text in this view -->
            <div class="card submit-review">
              <div class="card-body">
                <?php if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) { ?>
                <!-- Title for page in the body letting the user know there are on the submit reviews page -->
                <h5 class="card-title">Every Review Helps the Community!</h5>
                <?php 
                  if(!empty($rev_title_err)){
                    echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style=\"margin: 1% auto; width: 50%; text-align: center;\">$rev_title_err</div>";
                  }

                  if(!empty($rev_descr_err)){
                    echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style=\"margin: 1% auto; width: 50%; text-align: center;\">$rev_descr_err</div>";
                  }
                ?>
                <!-- Form Element to record the user's submit review request -->
                <form class="submit-review-form" id="submit-review" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?parkid=".$parkid; ?>" method="post">
                  <!-- Inputs broken up into groups to allow for placing elements inline on desktop -->
                  <div class="first-group">
                    <!-- Each input has a unique name for customizing css for its size -->
                    <div class="review-title-input">
                    <!-- Each label uses the same CSS styling -->
                      <label for="review-title" class="form-label title-label">Review Title:</label>
                      <div class="input-group mb-3">
                        <input type="text" name="title" class="form-control" id="review-title">
                      </div>
                    </div>
                  </div>
                  <br>
                  <!-- Big TextArea input type to allow user to leave detailed review description -->
                  <label class="form-label">Description:</label>
                  <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                  <br>
                  <label class="form-label title-label">Rating:</label>
                    <!-- Checkboxes resembling buttons to allow user to choose level of anonymity for review to be submitted -->
                    <div class="btn-group custom-group" id="ratings" role="group" aria-label="Basic radio toggle button group">
                      <input type="radio" class="btn-check" name="rating-val" id="btnradio1" value="1" >
                      <label class="btn btn-outline-primary" for="btnradio1">1</label>
                      <input type="radio" class="btn-check" name="rating-val" id="btnradio2" value="2">
                      <label class="btn btn-outline-primary" for="btnradio2">2</label>
                      <input type="radio" class="btn-check" name="rating-val" id="btnradio3" value="3" checked>
                      <label class="btn btn-outline-primary" for="btnradio3">3</label>
                      <input type="radio" class="btn-check" name="rating-val" id="btnradio4" value="4">
                      <label class="btn btn-outline-primary" for="btnradio4">4</label>
                      <input type="radio" class="btn-check" name="rating-val" id="btnradio5" value="5">
                      <label class="btn btn-outline-primary" for="btnradio5">5</label>
                    </div>
                </form>
                <!-- Finally, Submit Button used to submit form -->
                <button id="submit-review-btn" form="submit-review" type="submit" class="btn btn-outline-primary">Submit</button>
                <?php } else { ?>
                  <h3 class="login-page-title">Please Register or Login to submit a review<h3>
                  <div id="login-register-container">
                    <form action="./user_registration.php">
                      <button type="submit" class="btn btn-primary btn-lg" id="submit-signup-form" style="display: inline-flex;">Register</button>
                    </form>
                    <form action="./user_login.php">
                      <button type="submit" class="btn btn-primary btn-lg" id="submit-signup-form" style="display: inline-flex;">Login</button>
                    </form>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Page footer containing copyright and navigation links to all of our main pages -->
    <!-- Py and Px involve spacing vertically and horizontally respectively, justify center keeps the content centered -->
    <!-- text-muted gives the footer text that grey look -->
    <footer class="py-3">
      <?php include 'components/footer.inc' ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
  </body>
</html>