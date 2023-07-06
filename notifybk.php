<?php
ob_start();
error_reporting(E_ERROR | E_PARSE);
session_start();

$lastid=0;
if (isset($_GET['id'])){
          $lastid=$_GET['id'];
}
echo $lastid;
//INPUT CLEANING FUNCTION
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$city=$_SESSION['city'];
$name=$_SESSION['name'];
$con = mysqli_connect("localhost","root","","food");
$t=time();
$qr="SELECT * FROM `notifications` where `count` > '$lastid' AND `to`='$name'";
$res=mysqli_query($con,$qr);

while($rc=mysqli_fetch_array($res)){
  $f=1;
  echo '<div class="card"><div class="card-body">'.$rc['msg'].'</div><div class="card-footer">'.$rc['time'].'</div></div>';
  $id=$rc['count'];
}
$id++;
echo '<input type="hidden" id="lastid" value="'.$id.'" ng-model="id">';
?>