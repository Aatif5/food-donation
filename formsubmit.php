<?php
include 'nav.php'; // TO ACCESS SESSION VARIABLES
$name=$_SESSION['name'];
// FOR ADDING orderS
if (isset($_POST['units'])){
          $units = test_input($_POST["units"]);
          $con = mysqli_connect("localhost","root","","food");
          $qr="INSERT INTO `available`(`donor`, `units`) VALUES ('$name','$units')";
          $res=mysqli_query($con,$qr);
          $city=$_SESSION['city'];
          $qr="SELECT * FROM `users` where `city`='$city' and `type`='receiver'";
          $res=mysqli_query($con,$qr);
          while($item=mysqli_fetch_array($res)){
                    $to=$item['name'];
                    $msg=$name.' has some '.$units.' units of food';
                    $qr1="INSERT INTO `notifications`(`to`, `msg`) VALUES ('$to','$msg')";
                    $res1=mysqli_query($con,$qr1);
          }
          header("Location: adddonation.php?order=1");
          die();
}
// FOR REQUESTING orderS
elseif (isset($_POST['request'])) {
          $id=$_POST['request'];
          $con = mysqli_connect("localhost","root","","food");
          $qr="INSERT INTO `requests`(`order`, `user`) VALUES ('$id','$name')";
          $res=mysqli_query($con,$qr);
          $qr="SELECT * FROM `available` where `order_id`='$id'";
          $res=mysqli_query($con,$qr);
          $item=mysqli_fetch_array($res);
          $to=$item['donor'];
          $msg=$name.' has requested for your donation';
          $qr="INSERT INTO `notifications`(`to`, `msg`,`id`) VALUES ('$to','$msg','$id')";
          $res=mysqli_query($con,$qr);

          header("Location: index.php?request=1");
          die();
}
// FOR REQUESTING orderS
elseif (isset($_POST['delivered'])) {
          $id=$_POST['delivered'];
          $from=$_SESSION['name'];
          $to=$_POST['to'];
          $units=$_POST['quantity'];
          $con = mysqli_connect("localhost","root","","food");
          $qr="INSERT INTO `history`(`donor`, `receiver`,`units`) VALUES ('$from','$to','$units')";
          $res=mysqli_query($con,$qr);
          $qr="DELETE FROM `requests` WHERE `order`='$id'";
          $res=mysqli_query($con,$qr);
          $qr="DELETE FROM `notifications` WHERE `id`='$id'";
          $res=mysqli_query($con,$qr);
          $qr="DELETE FROM `available` WHERE `order_id`='$id'";
          $res=mysqli_query($con,$qr);
          header("Location: index.php?delivered=1");
          die();
}
// DEFAULT
else{
          header("Location: index.php");
}
?>