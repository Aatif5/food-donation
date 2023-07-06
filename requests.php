<?php
include 'nav.php';
if (isset($_SESSION['type']) and $_SESSION['type']=='donor'){

}
else{
  header("Location: index.php");
  die();
}
$name=$_SESSION["name"];
$con = mysqli_connect("localhost","root","","food");
$qr="SELECT * FROM `available` JOIN `requests` ON (`available`.`order_id`=`requests`.`order` AND `available`.`donor`='$name')";
$res=mysqli_query($con,$qr);
?>
<html lang="en">
  <body>
    <div class="container">
      <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php
        while($item=mysqli_fetch_array($res)){
          //print_r($item);
          $rc=$item['user'];
          $qr1="SELECT `contact` FROM `users` where `name`='$rc'";
          $res1=mysqli_query($con,$qr1);
          $contact=mysqli_fetch_array($res1);
          //print_r($contact);
      ?>
        <div class="col">
          <div class="card">
            <div class="card-header">
              From <b><?php echo $item['user']; ?></b>
            </div>
            <div class="card-body">
              <div class="card-title"><i class="material-icons">phone_in_talk</i> Contact: <?php echo $contact['contact'];?></div>
              <p class="card-text"> <?php echo $item['units']; ?> Units</p>
              <form method="post" action="formsubmit.php">
                <input type="hidden" name="delivered" value="<?php echo $item['order_id']; ?>"/>
                <input type="hidden" name="quantity" value="<?php echo $item['units']; ?>"/>
                <input type="hidden" name="to" value="<?php echo $rc; ?>"/>
                <button type="submit" class="btn btn-danger"><i class="material-icons">done</i> Delivered</button>
              </form>
            </div>
          </div>
        </div>
      <?php
        }
      ?>
      </div>
    </div>
  </body>
</html>
<?php
  include 'footer.html';
?>