<?php
include 'nav.php';
if (isset($_SESSION["name"]) and isset($_SESSION["type"])) {
  header('Location:index.php');
  die();
}
if(isset($_GET['error']) and $_GET['error']==1){
  ?>
      <script>alert("Username already exists.");</script>
  <?php
}
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)) {
  $name = test_input($_POST["name"]);
  $pass = test_input($_POST["pass"]);
  $cpass = test_input($_POST["cpass"]);
  $contact = test_input($_POST["number"]);
  $type = test_input($_POST["type"]);
  $city = test_input($_POST["city"]);
  $state = test_input($_POST["state"]);
  $zip = test_input($_POST["zip"]);
  $address=$_POST["address1"].','.$_POST["address2"].','.$city.','.$state.','.$zip;
  if ($pass != $cpass){
    ?>
    <script>alert("Password and Confirm Password donot match");</script>
    <?php
  }
  else{
    $con = mysqli_connect("localhost","root","","food");
    $qr="SELECT * FROM `users` WHERE `name`='$name'";
    $res=mysqli_query($con,$qr);
    $dis=mysqli_fetch_assoc($res);
    if ($dis){
      header("Location: registration.php?error=1");
      die();
    }
    $qr="INSERT INTO `users`(`name`, `pass`, `type`, `contact`, `address`, `city`,`state`,`zip`) VALUES ('$name','$pass','$type','$contact','$address','$city','$state','$zip')";
    $res=mysqli_query($con,$qr);
    $_SESSION['name']=$name;
    $_SESSION['type']=$type;
    $_SESSION['city']=$city;
    header("Location: index.php");
    die();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="generator" content="Hugo 0.72.0" />
    <title>Sign Up</title>
  </head>
  <body>
    <!-- Form -->
    <div class="container">
      <div class="row">
        <div class="container col-lg-6 justify-content-center">
          <form class="row g-3 align-items-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="col-12">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Username"
                  required
                />
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <input
                  type="password"
                  class="form-control"
                  id="pass"
                  name="pass"
                  placeholder="Password"
                  required
                />
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <input
                  type="password"
                  class="form-control"
                  id="cpass"
                  name="cpass"
                  placeholder="Confirm Password"
                  required
                />
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <input
                  type="number"
                  min="1000000000"
                  max="9999999999"
                  class="form-control"
                  id="number"
                  name="number"
                  placeholder="Contact No."
                  required
                />
              </div>
            </div>

            <div class="col-12">
              <div class="input-group">
                <select
                  class="form-select"
                  aria-label="Default select example"
                  name="type"
                  id="type"
                  required
                >
                  <option disabled selected value=<?php echo NULL; ?>>User Type</option>
                  <option value="donor">Hotel/Banquet Hall</option>
                  <option value="receiver">Receiver/NGO</option>
                </select>
              </div>
            </div>

            <div class="col-12">
              <input type="text" class="form-control" id="address1" name="address1" placeholder="Address-1" reqiured>
            </div>
            <div class="col-12">
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Address-2" required>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" name="city" placeholder="City" required>
            </div>
            <div class="col-md-4">
              <select name="state" class="form-select" placeholder="State" required>
                <option disabled selected>State</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Telangana">Telangana</option>
              </select>
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" name="zip" placeholder="Zip" required>
            </div>
      

            <div class="col-12">
              <button type="submit" class="btn btn-danger">Sign Up</button>
              <a class="btn btn-outline-danger" href="login.php">Log in</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
  include 'footer.html';
?>