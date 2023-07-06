<br>
      <h3 id="availablebloodorders"><center>Donations</center></h3>
<br>
<div class="container">
  <div class="row row-cols-1 row-cols-md-2 g-4">
<?php
// REQUEST BUTTON ONLY FOR RECEVIERS
$btn=FALSE;
if (isset($_SESSION['type'])){
  if ($_SESSION['type']=='receiver'){
    $btn=TRUE;
    $name=$_SESSION["name"];
    // FOR RECEVIER BLOOD GROUP
    $con = mysqli_connect("localhost","root","","food");
    $qr="SELECT * FROM `requests` where `user`='$name'";
    $res=mysqli_query($con,$qr);
    $temp=mysqli_fetch_assoc($res);
    if (isset($temp)){
      $btn=FALSE;
    }
  }
}
else{
  header("Location: index.php");
  die();
}
if($btn){
$con = mysqli_connect("localhost","root","","food");
// FETCH ORDERS
$city=$_SESSION['city'];
$qr="SELECT * FROM `available` INNER JOIN `users` ON available.donor=users.name AND users.city='$city'";
$res=mysqli_query($con,$qr);
// DISPLAY ORDERS
while($item=mysqli_fetch_assoc($res)){
?>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            From: <?php echo $item['donor']; ?>
          </h5>
          <p class="card-text">
            Available: <?php echo $item['units'],' Units'; ?>
          </p>
          <p class="card-text">
          <i class="material-icons">place</i>
            Address: <?php echo $item['address']; ?>
          </p>
            <form method="post" action="formsubmit.php">
              <input type="hidden" name="request" value="<?php echo $item['order_id']; ?>"/>
              <button type="submit" class="btn btn-danger"><i class="material-icons">forward</i> Request order</button>
            </form>
        </div>
      </div>
    </div>

<?php
}
}

elseif (!$btn && $_SESSION['type']=='receiver'){
  $con = mysqli_connect("localhost","root","","food");
  $id=$temp['order'];
  $qr="SELECT * FROM `available` where `order_id`='$id'";
  $res=mysqli_query($con,$qr);
  $temp=mysqli_fetch_assoc($res);
?>

  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          From: <?php echo $temp['donor']; ?>
        </h5>
        <p class="card-text">
          <?php echo $temp['units'],' Units'; ?>
        </p>
        <p class="card-text">
          Status: Waiting...
        </p>
      </div>
    </div>
  </div>

<?php

}
?>
    
  </div>
</div>
