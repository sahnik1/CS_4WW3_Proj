<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- importing style sheets, ours and bootstrap's -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/parkview.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/footer.css">
    <!-- meta tags specifying charset, and user visible area -->
    <meta charset="utf-8">
    <title>Paw Go - Oakville Dog Park</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view">
      <!-- Title of view, shows which park information currently looking at -->
      <h2 class="park-title">Oakville Dog Park</h2>
      <!-- Container for resizing the dog park image for mobile/desktop -->
      <div class="park-img-container">
        <img class="park-img" src="./images/oakville-dog-park.jpg" alt="Dog Park Picture">
      </div>
      <!-- Another container, this ensures that in the mobile view, we see a different containerized view -->
      <div class="content-container">
        <!-- Tabbed navs for switching between content related to the dog park -->
        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <form action="object_page.html">
              <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="submit" role="tab" aria-selected="true">Information</button>
            </form>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-selected="false">Reviews</button>
          </li>
          <li class="nav-item" role="presentation">
            <form action="object_submit_review.html">
              <button class="nav-link" id="submit-reviews-tab" data-bs-toggle="tab" data-bs-target="#submit-reviews" type="submit" role="tab" aria-selected="false">Submit Review</button>
            </form>
          </li>
        </ul>
        <!-- This container is referred to by the tab that is selected above -->
        <!-- Since Js is not allowed in Assignment 1, we broke up the links into separate pages -->
        <div class="tab-content">
          <div class="tab-pane active" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
            <!-- Each Review is put inside its own Card -->
            <!-- Each of these cards are then turned into flex containers on desktop -->
            <div class="card park-reviews">
              <div class="card-body review">
                <!-- Each Review has a title -->
                <h6 class="card-title">Great Park, Must Visit!!</h6>
                <!-- Each Review has the author name or if the user chooses "Anonymous" -->
                <p class="card-subtitle mb-2 text-muted">Samantha Nunez</p>
                <!-- Each Review has an inline container for the ratings the user provided -->
                <div class="rating-container">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </div>
                <!-- Each Review has the description the user chose to write for their review -->
                <p class="description">
                  It's really well maintained and run by a group of volunteers and sponsors who help keep the dog park clean and tidy for everybody to benefit.
                </p>
              </div>
            </div>
            <div class="card park-reviews">
              <div class="card-body review">
                <h6 class="card-title">Bad Experience with my puppy :(</h6>
                <p class="card-subtitle mb-2 text-muted">John Smith</p>
                <div class="rating-container">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                </div>
                <p class="description">
                  The worst dog park in the GTA. If you have small and medium dog don't even bother to go there.
                </p>
              </div>
            </div>
            <div class="card park-reviews">
              <div class="card-body review">
                <h6 class="card-title">Lots of space, but be cautious!</h6>
                <p class="card-subtitle mb-2 text-muted">Elon Musk</p>
                <div class="rating-container">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                </div>
                <p class="description">
                  There’s a great amount of space in this dog park. It features a wooded area, agility section, small dogs / puppies section, and of course a general off leash area with park benches & seasonal water.
                </p>
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
  </body>
</html>