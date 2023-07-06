<?php
include 'nav.php';
if (isset($_SESSION["name"]) and isset($_SESSION["type"])) {
  header('Location:index.php');
  die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)) {
  $name = test_input($_POST["name"]);
  $pass = test_input($_POST["pass"]);
  $con = mysqli_connect("localhost","root","","food");
  $qr="SELECT * FROM `users` WHERE `name`='$name'";
  $res=mysqli_query($con,$qr);
  $dis=mysqli_fetch_assoc($res);
  if(isset($dis['pass']) and $pass==$dis['pass']){
    $_SESSION['name']=$name;
    $_SESSION['type']=$dis['type'];
    $_SESSION['city']=$dis['city'];
    header('Location: index.php');
    die();
  }
  else {
   ?>
   <script>alert("Incorrect Password or User Doesn`t Exist");</script>
   <?php 
  }
}

?>
<html lang="en">
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
                />
              </div>
            </div>

      

            <div class="col-12">
              <button type="submit" class="btn btn-danger">
                Log in
              </button>
              <a class="btn btn-outline-danger" href="registration.php">Sign Up</a>
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