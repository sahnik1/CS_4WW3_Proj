<?php 

session_start();

// Include config file
require_once "config.php";

$sql = "SELECT address, phone, dateofbirth FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);

$results = array();

if ($stmt){
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
    $param_id = $_SESSION["id"];

    if ($stmt->execute()){
        if ($stmt->rowCount() == 1){
            $row = $stmt->fetch();

            if ($row) {
                $results["address"] = $row["address"];
                $results["phone"] = $row["phone"];
                $results["dateofbirth"] = $row["dateofbirth"];
            }
        }
    }
}

?>

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
    <title>Paw Go - Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
  <body>
  <header>
      <?php include 'components/nav_menu.inc' ?>
  </header>
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view" style="width: 50%;">
      <h2 class="signup-title">Profile</h2>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container" style="margin: auto; width: 95%">
        <h4 style="color: white;">Name: <?php echo $_SESSION["username"]?></h4>
        <br>
        <h4 style="color: white;">Email: <?php echo $_SESSION["email"]?></h4>
        <br>
        <h4 style="color: white;">Address: <?php echo $results["address"]?></h4>
        <br>
        <h4 style="color: white;">Phone: <?php echo $results["phone"]?></h4>
        <br>
        <h4 style="color: white;">Date of Birth: <?php echo $results["dateofbirth"]?></h4>
      </div>
    </div>
    <!-- Page footer containing copyright and navigation links to all of our main pages -->
    <!-- Py and Px involve spacing vertically and horizontally respectively, justify center keeps the content centered -->
    <!-- text-muted gives the footer text that grey look -->
    <footer class="py-3">
      <?php include 'components/footer.inc' ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="scripts/form_validation.js"></script>
  </body>
</html>