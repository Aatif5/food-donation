<?php
include 'nav.php';
?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<div class="container">
  <div class="row row-cols-1 row-cols-md-2 g-4">
<div id="notify" ng-app="">
<?php
$city=$_SESSION['city'];
$name=$_SESSION['name'];
$con = mysqli_connect("localhost","root","","food");
$qr="SELECT * FROM `notifications` where `to`='$name' order by time desc";
$res=mysqli_query($con,$qr);
$lastid=0;
while($rc=mysqli_fetch_array($res)){
    $lastid=$rc['count'];
?>
<div class="card">
  <div class="card-body">
  <?php
  echo $rc['msg'];  
  ?>
  </div>
  <div class="card-footer">
      <?php
      echo $rc['time'];
      ?>
</div>
</div>
<?php
}
?>
<p ng-bind="id"></p>
</div>
</div>
</div>
 
</body>
<?php
include 'footer.html';
?>
<script>
    var y='<?php echo $lastid;?>';
//setInterval(notify, 3000);
    function notify() {
        //var y=0;
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            var x=this.responseText;
            document.getElementById('notify').innerHTML=x+document.getElementById('notify').innerHTML;
            y=document.getElementById('lastid').value;
            //alert(y);
    }
    y++;
  xmlhttp.open("GET", "notifybk.php?id="+y,true);
  xmlhttp.send();
  }
</script>