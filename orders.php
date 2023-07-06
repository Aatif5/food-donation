<?php
include 'nav.php';
?>
<html lang="en">
  <body>
          <?php
          if (isset($_SESSION['type']) and $_SESSION['type']=='receiver'){
                    include 'available.php';
          }
          else{
            header("Location: index.php");
            die();
          }
          ?>
    
  </body>
</html>
<?php
  include 'footer.html';
?>