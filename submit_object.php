<?php 

// Start/continue the session
session_start();

// Include Config File
require_once "config.php";
// Include S3 Config File
require_once "upload-to-s3.php";

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $image = $_FILES['park_image'];

  $image_ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
  $type = "";
  if ($image_ext == 'jpeg' || $image_ext == 'jpg'){
    $type = "image/jpg";
  } elseif ($image_ext == 'gif'){
    $type = "image/gif";
  } elseif ($image_ext == 'png'){
    $type = "image/png";
  } else {
    $error_msg = "Error: Only PNG, JPG/JPEG and GIF Files Accepted";
  }

  $park_name = trim($_POST["park-name"]);
  $puppies = trim($_POST["puppies"]);
  $descr = trim($_POST["description"]);
  $addr = trim($_POST["address"]);
  $city = trim($_POST["city"]);
  $prov = trim($_POST["province"]);

  if (!empty($park_name) && !empty($puppies) && !empty($descr) && !empty($addr) && !empty($city) && !empty($prov) && !empty($error_msg)){
    // SQL Template to insert new user
    $sql = "INSERT INTO parks_info (name, puppies, description, address, city, province, avgrating) VALUES (:park, :puppy, :descr, :addr, :city, :prov, :rating)";
    $stmt = $pdo->prepare($sql);
    if ($stmt) {
      $stmt->bindParam(":park", $param_park);
      $param_park = $park_name;

      $stmt->bindParam(":puppy", $param_puppy);
      if (strtolower($puppies) == "yes"){
        $param_puppy = 1;
      } else {
        $param_puppy = 0;
      }

      $stmt->bindParam(":descr", $param_descr);
      $param_descr = $descr;

      $stmt->bindParam(":addr", $param_addr);
      $param_addr = $addr;

      $stmt->bindParam(":city", $param_city);
      $param_city = $city;

      $stmt->bindParam(":prov", $param_prov);
      $param_prov = $prov;

      // Default rating assigned to a park is zero
      $stmt->bindParam(":rating", $param_rating);
      $param_rating = 0;

      if ($stmt->execute()){

        $parkid = $pdo->lastInsertId();
        $result = $s3Client->putObject([
          'Bucket' => 'paw-go-park-images',
          'Key' => $parkid,
          'SourceFile' => $image["tmp_name"],
          'ContentType' => $type
        ]);
        // User Info Saved in DB, Therefore we redirect to login
        header("location: object_page.php?parkid=".$parkid);

      } else {
        echo "Something Went Wrong";
      }

      unset($stmt);
    }
  } elseif (empty($error_msg)){
    $error_msg = "Please check your input";
  }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- importing style sheets, ours and bootstrap's -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/form_validation.css">
    <link rel="stylesheet" href="styles/signup.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <!-- meta tags specifying charset, and user visible area -->
    <meta charset="utf-8">
    <title>Paw Go - Submit Park</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <?php include 'components/nav_menu.inc' ?>
    </header>
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view">
      <!-- Title of view, shows user they are are Park Submission Page -->
      <h2 class="signup-title">Don't See a Park Listed? Add it Here!</h2>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container">
        <!-- Signup Page Form Element to record user's park submission -->
        <?php if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === true) { ?>
        <form class="signup-form" id="submit-park-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
          <!-- Container to allow for different view on desktop vs mobile -->
          <div class="form-row multi-input-row">
            <!-- Text HTML5 Field for Park Name -->
            <div class="form-group form-field">
              <label class="label-field" for="name-input">Park Name</label>
              <!-- Required Field -->
              <input type="text" class="form-control" name="park-name" id="name-input" placeholder="Enter park name" required minlength="6" maxlength="100">
            </div>
            <!-- Selection HTML5 Field for Park Preferences -->
            <div class="form-group form-field">
              <label class="label-field" for="puppies-input">Puppies Allowed?</label>
              <select id="puppies-input" name="puppies" class="form-control" required>
                <option value="" selected>Select</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <!-- TextArea HTML5 Field for Park Description -->
          <div class="form-group form-field">
            <label class="label-field">Description</label>
            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea" required minlength="10" maxlength="250"></textarea>
          </div>
          <!-- Text HTML5 Field for Address -->
          <div class="form-group form-field">
            <label class="label-field" for="address-input">Address</label>
            <input type="text" class="form-control" name="address" id="address-input" placeholder="1234 Main St" required>
            <button id="submit-find-me" type="button" class="btn btn-primary location-btn col-4" onclick="findLocation(this)">Find Me</button>
          </div>
          <!-- Text HTML5 Field for City Park is Located in -->
          <div class="form-row multi-input-row">
            <div class="form-group form-field">
              <label class="label-field" for="city-input">City</label>
              <input type="text" class="form-control" name="city" id="city-input" placeholder="Toronto" required>
            </div>
            <!-- Selection HTML5 Field for Choosing Province Park Located in -->
            <div class="form-group form-field">
              <label class="label-field" for="province-input">Province</label>
              <select id="province-input" name="province" class="form-control" required>
                <option value="" selected>Select</option>
                <?php 
                  $provinces = array('Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland & Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'P.E.I', 'Quebec', 'Saskatchewan', 'Yukon');
                  foreach ($provinces as $value) {
                    echo "<option>$value</option>";
                  }
                ?>
              </select>
            </div>
            <!-- File Upload HTML5 Field for Uploading Park Image -->
            <div class="form-group form-field">
              <label class="label-field" for="upload-input">Image Upload</label>
              <input type="file" name="park_image" class="form-control" id="upload-input" required>
            </div>
          </div>
        </form>
        <!-- Submit Button Linked to Form Element Above -->
        <button type="submit" form="submit-park-form" id="submit-signup-form" class="btn btn-primary">Submit Park for Review</button>
        <?php } else { ?>
          <div id="login-register-container">
            <form action="./user_registration.php">
              <button type="submit" class="btn btn-primary btn-lg" id="submit-signup-form" style="display: inline-flex;">Register</button>
            </form>
            <form action="./user_login.php">
              <button type="submit" class="btn btn-primary btn-lg" id="submit-signup-form" style="display: inline-flex;">Login</button>
            </form>
          </div>
        <?php }?>
      </div>
    </div>
    <!-- Page footer containing copyright and navigation links to all of our main pages -->
    <!-- Py and Px involve spacing vertically and horizontally respectively, justify center keeps the content centered -->
    <!-- text-muted gives the footer text that grey look -->
    <footer class="py-3">
      <?php include 'components/footer.inc' ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="scripts/index.js"></script>
  </body>
</html>