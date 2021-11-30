<?php
  // Start/Resume the Session
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- meta tags specifying charset, and user visible area -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paw Go - Home</title>
    <!-- importing style sheets, ours and bootstrap's, and fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <?php include 'components/nav_menu.inc' ?>
    </header>
    <!-- Main container of the index page which holds the page name and logo, a tagline and the main search form -->
    <div class="main-container">
      <div class="title-container">
        <h1>Paw Go</h1>
        <img src="images/dog-paw-icon.png" alt="Dog Paw Icon">
      </div>
      <div class="tagline">
        <p>Find Dog Parks Near You</p>
      </div>
      <!-- search form that when submitted redirects to the results_sample page -->
      <form class="search-form" action="results_sample.php">
        <input type="text" class="form-control search-input" placeholder="Enter location here" id="user-location-search">
        <select id="rating-search" class="form-control">
          <option selected>Rating</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <div class="row btn-container justify-content-center">
          <button id="find-location" type="button" class="btn btn-primary location-btn col-4" onclick="findLocation(this)">Find Me</button>
          <button id="search-form-submit" type="submit" class="btn btn-primary search-btn col-8">Search</button>
        </div>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="scripts/index.js"></script>
  </body>
</html>