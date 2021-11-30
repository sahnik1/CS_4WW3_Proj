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
    <title>Paw Go - Oakville Dog Park</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
  </head>
  <body>
    <header>
      <?php include 'components/nav_menu.inc' ?>
    </header>
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view">
      <!-- Title of view, shows which park information currently looking at -->
      <h2 class="park-title">Oakville Dog Park</h2>
      <!-- Container for resizing the dog park image for mobile/desktop -->
      <div class="park-img-container">
        <img class="park-img" src="./images/oakville-dog-park.jpg" alt="Dog Park Picture">
      </div>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container">
        <!-- Tabbed navs for switching between content related to the dog park -->
        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Information</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-selected="false">Reviews</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link" id="submit-reviews-tab" data-bs-toggle="tab" data-bs-target="#submit-reviews" type="button" role="tab" aria-selected="false">Submit Review</button>
          </li>
        </ul>
        <!-- This container is referred to by the tab that is selected above -->
        <div class="tab-content">
            <!-- This shows that the current tab content is active and therefore displayed -->
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <!-- Using Bootstrap Card element here to encompass the park details and map, also allows responsive design -->
            <div class="card">
              <div class="card-body">
                  <!-- Inner container to separat block of text from the map image -->
                <div class="inner-card-container">
                  <!-- Dog Park Title as shown in Description -->
                  <h4 class="card-title">Oakville Dog Park</h4>
                  <br>
                  <!-- Dog Park Address as shown in Description -->
                  <h5 class="card-subtitle mb-2 text-muted">230 Random St, Oakville, ON L67M35</h5>
                  <br>
                  <!-- Span element to show inline the average rating using star icons in Bootstrap -->
                  <span>
                  Average Rating:
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  </span>
                  <br>
                </div>
                  <!-- Container to separate the map from the text and allow responsive resizing -->
                  <div class="map-container">
                    <div id="Park-Map" >
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
                $titles = array("Bad Experience with my puppy :(", "Great Park, Must Visit!!", "Lots of space, but be cautious!");
                $authors = array("John Smith", "Samantha Nunez", "Elon Musk");
                $ratings = array(1, 5, 3);
                $descr = array("The worst dog park in the GTA. If you have small and medium dog don't even bother to go there.", "It's really well maintained and run by a group of volunteers and sponsors who help keep the dog park clean and tidy for everybody to benefit.", "There’s a great amount of space in this dog park. It features a wooded area, agility section, small dogs / puppies section, and of course a general off leash area with park benches & seasonal water.");
                $total_reviews = count($titles);
                for ($index = 0;$index < $total_reviews; $index++) { ?>
                  <div class="card park-reviews">
                    <div class="card-body review">
                      <?php echo "<h6 class=\"card-title\">".$titles[$index]."</h6>" ?>
                      <?php echo "<p class=\"card-subtitle mb-2 text-muted\">".$authors[$index]."</p>" ?>
                      <div class="rating-container">
                        <?php for ($star = 0;$star < $ratings[$index]; $star++) {?>
                        <i class="bi bi-star-fill"></i>
                        <?php } ?>
                        <?php for ($star = 5 - $ratings[$index];$star > 0; $star--) {?>
                        <i class="bi bi-star"></i>
                        <?php } ?>
                      </div>
                      <?php echo "<p class=\"description\">".$descr[$index]."</p>" ?>
                    </div>
                  </div>
              <?php } ?>
            </div>
          </div>
          
          <div class="tab-pane fade" id="submit-reviews" role="tabpanel" aria-labelledby="submit-reviews-tab">
            <!-- Using Bootstrap Card element for body of the form and text in this view -->
            <div class="card submit-review">
              <div class="card-body">
                <!-- Title for page in the body letting the user know there are on the submit reviews page -->
                <h5 class="card-title">Every Review Helps the Community!</h5>
                <br>
                <!-- Form Element to record the user's submit review request -->
                <!-- Form is tied to the submit button, for now in Assignment 1 they are not connected as we cannot use Js -->
                <form class="submit-review-form">
                  <!-- Inputs broken up into groups to allow for placing elements inline on desktop -->
                  <div class="first-group">
                    <!-- Each input has a unique name for customizing css for its size -->
                    <div class="review-title-input">
                    <!-- Each label uses the same CSS styling -->
                      <label for="review-title" class="form-label title-label">Review Title:</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" id="review-title">
                      </div>
                    </div>
                    <!-- Checkboxes resembling buttons to allow user to choose level of anonymity for review to be submitted -->
                    <div class="btn-group custom-group" role="group" aria-label="Basic radio toggle button group">
                      <input type="radio" class="btn-check" name="btnradio" id="showmyname"  checked>
                      <label class="btn btn-outline-primary" for="showmyname">Show My Name</label>
                      <input type="radio" class="btn-check" name="btnradio" id="anonymous" >
                      <label class="btn btn-outline-primary" for="anonymous">Anonymous Review</label>
                    </div>
                  </div>
                  <br>
                  <!-- Big TextArea input type to allow user to leave detailed review description -->
                  <label class="form-label">Description:</label>
                  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                  <br>
                </form>
                <!-- Lastly, this form is to allow user to leave a Rating as a part of their review -->
                <!-- Similar styling to "Anonymous" selection above, checkboxes resembling button used from Bootstrap -->
                <form class="submit-review-form">
                  <label class="form-label title-label">Rating:</label>
                  <div class="btn-group custom-group" id="ratings" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" >
                    <label class="btn btn-outline-primary" for="btnradio1">1</label>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" >
                    <label class="btn btn-outline-primary" for="btnradio2">2</label>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3"  checked>
                    <label class="btn btn-outline-primary" for="btnradio3">3</label>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" >
                    <label class="btn btn-outline-primary" for="btnradio4">4</label>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" >
                    <label class="btn btn-outline-primary" for="btnradio5">5</label>
                  </div>
                </form>
                <!-- Finally, Submit Button used to submit form -->
                <button id="submit-review-btn" type="submit" class="btn btn-outline-primary" data-bs-target="#reviews">Submit</button>
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
    <script src="./scripts/map_object_page.js"></script>
  </body>
</html>