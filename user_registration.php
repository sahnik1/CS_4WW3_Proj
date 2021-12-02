<?php 
// Include config file
require_once "config.php";

// Defining the username/password variables
$user = "";
$pass = "";
$user_err = "";
$pass_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  // Server Side Validation of Username
  if (empty(trim($_POST["email"]))){
    $user_err = "Please Enter an Email Address";
  } else {
    $sql_template = "SELECT id FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql_template);
    if ($stmt) {
      // Bind Vars to Prepared Stmt as params
      $stmt->bindParam(":email", $param_user, PDO::PARAM_STR);
      // Set Params
      $param_user = trim($_POST["email"]);

      // We Try to run the SQL stmt
      if ($stmt->execute()){
        // If successful and user already exists in DB
        if($stmt->rowCount() == 1){
          $user_err = "This Email is Already Registered";
        } else {
          // Since user not in DB, safe to add new user
          $user = trim($_POST["email"]);
        }
      } else {
        echo "Something Went Wrong, Please Try Again Later!";
      }

      // Close the connection
      unset($stmt);
    }
  }

  // Server Side Validation of Password
  if(empty(trim($_POST["password"]))){
    $pass_err = "Please Enter a Password";
  } else {
    $pass = trim($_POST["password"]);
  }

  $name = trim($_POST["name"]);
  $addr = trim($_POST["address"]);
  $phone = str_replace("-", "", trim($_POST["phone"]));
  $province = trim($_POST["province"]);
  $dob = trim($_POST["dob"]);

  // Insert User + Pass into DB for New User
  if(empty($user_err) && empty($pass_err)){
    // SQL Template to insert new user
    $sql = "INSERT INTO users (email, password, name, address, phone, province, dateofbirth) VALUES (:user, :pass, :name, :addr, :phone, :prov, :dob)";
    $stmt = $pdo->prepare($sql);
    if ($stmt) {
      $stmt->bindParam(":user", $param_user);
      $param_user = $user;

      $stmt->bindParam(":pass", $param_pass);
      $param_pass = password_hash($pass, PASSWORD_DEFAULT);

      $stmt->bindParam(":name", $param_name);
      $param_name = $name;

      $stmt->bindParam(":addr", $param_addr);
      $param_addr = $addr;

      $stmt->bindParam(":phone", $param_phone);
      $param_phone = $phone;

      $stmt->bindParam(":prov", $param_prov);
      $param_prov = $province;

      $stmt->bindParam(":dob", $param_dob);
      $param_dob = $dob;

      if ($stmt->execute()){
        // User Info Saved in DB, Therefore we redirect to login
        header("location: index.php");
      } else {
        echo "Something Went Wrong";
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
      <h2 class="signup-title">Sign Up for Access!</h2>
      <?php 
      if(!empty($user_err)){
        $dismiss_btn = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style=\"margin: auto; width: 50%; text-align: center;\">$user_err</div>";
      }
      ?>
      <!-- Another container, this ensures that in the mobile view, we see a different view -->
      <div class="content-container">
        <!-- Signup Page Form Element to record user's signup request -->
        <form class="signup-form" id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validate()">
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
          <div class="form-row multi-input-row">
            <!-- Name Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="name-input">Full Name</label>
              <input type="text" name="name" class="form-control" id="name-input" placeholder="John A. Smith">
            </div>
            <!-- Address HTML5 Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="address-input">Address</label>
              <input type="text" name="address" class="form-control" id="address-input" placeholder="1234 Main St">
            </div>
          </div>
          <!-- Phone Number HTML5 Field for signup -->
          <div class="form-row multi-input-row">
            <div class="form-group form-field">
              <label class="label-field" for="tel-input">Phone Number</label>
              <input type="text" name="phone" class="form-control" id="tel-input" placeholder="905-905-9050">
            </div>
            <!-- Province Selection Field for signup -->
            <div class="form-group form-field">
              <label class="label-field" for="province-input">Province</label>
              <select id="province-input" name="province" class="form-control">
                <option selected>Select</option>
                <?php 
                  $provinces = array('Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland & Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'P.E.I', 'Quebec', 'Saskatchewan', 'Yukon');
                  foreach ($provinces as $value) {
                    echo "<option>$value</option>";
                  }
                ?>
              </select>
            </div>
            <!-- Date HTML5 Field for signup (Date of Birth) -->
            <div class="form-group form-field">
              <label class="label-field" for="dob-input">Date of Birth</label>
              <input type="date" name="dob" class="form-control" id="dob-input">
            </div>
          </div>
        </form>
        <!-- Submit button linked to Form Element above, For Assignment 1 this leads back to Home Page -->
        <button type="submit" form="signup-form" id="submit-signup-form" class="btn btn-primary">Sign Up</button>
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