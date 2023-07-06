<?php
include 'nav.php';
//REQUEST MESSAGE
if (isset($_GET['request']) and $_GET['request']=='1'){
  ?>
  <script>
    alert("Requested!");
  </script>
  <?php
}
elseif (isset($_GET['delivered']) and $_GET['delivered']=='1'){
  ?>
  <script>
    alert("Order Delivered Successfully!");
  </script>
  <?php
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
  </head>
  <body>
    <div class="container">
      <?php
      //FOR GUEST VISITORS
        if (!isset($_SESSION["name"]) and !isset($_SESSION["type"])) {
      ?>
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card text-center">
            <div class="card-body">
              <h5 class="card-title">Welcome to No Hunger.Org</h5>
              <p class="card-text">No Hunger Org is a website to manage the Food supply chain and reduce the food wastage.</p>
              <p class="card-text"><i>"Think Of The Poor Before You Waste Your Food."</i></p>
              <a href="registration.php" class="btn btn-danger">Get Started</a>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
        elseif ($_SESSION['type']=='receiver'){
          $total=0;
          $con = mysqli_connect("localhost","root","","food");
          $name=$_SESSION['name'];
          $qr="SELECT * FROM `history` WHERE `receiver`='$name'";
          $res=mysqli_query($con,$qr);
          ?>
          <h3><center>History</center></h3>
          <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
        
          <?php
          while($item=mysqli_fetch_assoc($res)){
            $total+=$item['units'];
          ?>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                  From: <?php echo $item['donor']; ?>
                </h5>
                <p class="card-text">
                   <?php echo $item['units'],' Units'; ?>
                </p>
                <p class="card-text">
                   <?php echo $item['time']; ?>
                </p>
              </div>
            </div>
          </div>
          <?php
          }
          
          ?>
          </div>
      </div>
      <br>
      <h3 ><center>Total Received: <?php echo $total,' Units';?></center></h3>
          <?php
          include 'available.php';
        }
        elseif ($_SESSION['type']=='donor'){
          $total=0;
          $con = mysqli_connect("localhost","root","","food");
          $name=$_SESSION['name'];
          $qr="SELECT * FROM `history` WHERE `donor`='$name'";
          $res=mysqli_query($con,$qr);
          ?>
          <h3><center>History</center></h3>
          <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
        
          <?php
          while($item=mysqli_fetch_assoc($res)){
            $total+=$item['units'];
          ?>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                  To: <?php echo $item['receiver']; ?>
                </h5>
                <p class="card-text">
                   <?php echo $item['units'],' Units'; ?>
                </p>
                <p class="card-text">
                   <?php echo $item['time']; ?>
                </p>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
          </div>
      </div>
      <br>
      <h3 ><center>Total Donated: <?php echo $total,' Units';?></center></h3>
      <?php
        }
        include 'footer.html';
      ?>
    </div>
  </body>
</html>
