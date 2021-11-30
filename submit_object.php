<?php 
// Start Session
session_start();
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
        <form class="signup-form" id="submit-park-form" action="./object_page.php">
          <!-- Container to allow for different view on desktop vs mobile -->
          <div class="form-row multi-input-row">
            <!-- Text HTML5 Field for Park Name -->
            <div class="form-group form-field">
              <label class="label-field" for="name-input">Park Name</label>
              <!-- Required Field -->
              <input type="text" class="form-control" id="name-input" placeholder="Enter park name" required minlength="6" maxlength="100">
            </div>
            <!-- Selection HTML5 Field for Park Preferences -->
            <div class="form-group form-field">
              <label class="label-field" for="puppies-input">Puppies Allowed?</label>
              <select id="puppies-input" class="form-control" required>
                <option value="" selected>Select</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <!-- TextArea HTML5 Field for Park Description -->
          <div class="form-group form-field">
            <label class="label-field">Description</label>
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" required minlength="10" maxlength="250"></textarea>
          </div>
          <!-- Text HTML5 Field for Address -->
          <div class="form-group form-field">
            <label class="label-field" for="address-input">Address</label>
            <input type="text" class="form-control" id="address-input" placeholder="1234 Main St" required>
            <button id="submit-find-me" type="button" class="btn btn-primary location-btn col-4" onclick="findLocation(this)">Find Me</button>
          </div>
          <!-- Text HTML5 Field for City Park is Located in -->
          <div class="form-row multi-input-row">
            <div class="form-group form-field">
              <label class="label-field" for="city-input">City</label>
              <input type="text" class="form-control" id="city-input" placeholder="Toronto" required>
            </div>
            <!-- Selection HTML5 Field for Choosing Province Park Located in -->
            <div class="form-group form-field">
              <label class="label-field" for="province-input">Province</label>
              <select id="province-input" class="form-control" required>
                <option value="" selected>Select</option>
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
            <!-- File Upload HTML5 Field for Uploading Park Image -->
            <div class="form-group form-field">
              <label class="label-field" for="upload-input">Image Upload</label>
              <input type="file" class="form-control" id="upload-input" required>
            </div>
          </div>
        </form>
        <!-- Submit Button Linked to Form Element Above -->
        <button type="submit" form="submit-park-form" id="submit-signup-form" class="btn btn-primary">Submit Park for Review</button>
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