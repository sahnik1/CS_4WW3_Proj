<?php 
// Include config file
require_once "config.php";

// Defining the username/password variables
$user = "";
$pass = "";
$user_err = "";
$pass_err = "";
$general_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  // Server Side Validation of Username
  if (empty(trim($_POST["email"]))){
    $user_err = "Please Enter an Email Address";
  } else {
    $user = trim($_POST["email"]);
  }

  // Server Side Validation of Password
  if(empty(trim($_POST["password"]))){
    $pass_err = "Please Enter a Password";
  } else {
    $pass = trim($_POST["password"]);
  }

  // Validate Credentials
  if(empty($user_err) && empty($pass_err)){
    // SQL template statement
    $sql = "SELECT id, name, email, password FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    if ($stmt){
      // Bind the var to the statment
      $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
      $param_email = trim($_POST["email"]);
      // First we check if the user even exists in our DB
      if ($stmt->execute()){
        // Check if we have exactly 1 user with same email
        if ($stmt->rowCount() == 1){
          $row = $stmt->fetch();
          if ($row){
            $user_id = $row["id"];
            $user_name = $row["name"];
            $user_email = $row["email"];
            $encrypted_pass = $row["password"];
            // Verify Hashed Password against entered Password
            if (password_verify($pass, $encrypted_pass)){
              // Since Password is correct, we update the session
              session_start();
              $_SESSION["signedin"] = true;
              $_SESSION["id"] = $user_id;
              $_SESSION["username"] = $user_name;
              header("location: index.php");
            } else {
              $signin_err = "Invalid Credentials, Please Try Again";
            }
          }
        } else {
          $general_err = "Invalid Credentials, Please Try Again";
        }
      } else {
        $general_err = "Something Went Wrong, Please Try Again";
      }
      unset($stmt);
    }
  }
  unset($pdo);
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
    <title>Paw Go - Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
  <body>
  <header>
      <?php include 'components/nav_menu.inc' ?>
  </header>
    <!-- Main view container, contains all of the main content for the page -->
    <div class="container-fluid mainview" id="main-view">
      <!-- Title of view, shows user they are at User Registration Page -->
      <h2 class="signup-title">Sign in to your account</h2>
      <?php 
      $errors = array($user_err, $pass_err, $general_err);
      foreach ($errors as $value) {
        if (!empty($value)){
          echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style=\"margin: 1% auto; width: 50%; text-align: center;\">$value</div>";
        }
      }
      $dismiss_btn = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
      ?>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container">
        <!-- Signup Page Form Element to record user's signup request -->
        <form class="signup-form" id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <!-- Container to allow for different view on desktop vs mobile -->
          <div class="form-row multi-input-row">
            <!-- Email HTML5 Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="email-input">Email</label>
              <input type="text" name="email" class="form-control" id="email-input" placeholder="email@gmail.com">
            </div>
            <!-- Password HTML5 Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="password-input">Password</label>
              <input type="password" name="password" class="form-control" id="password-input" placeholder="**********">
            </div>
          </div>
        </form>
        <button type="submit" form="signup-form" id="submit-signup-form" class="btn btn-primary">Login</button>
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