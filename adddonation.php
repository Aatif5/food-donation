<?php
  include 'nav.php';
  if (!isset($_SESSION['type']) and !($_SESSION['type']=='donor')){
    header("Location: index.php");
    die();
    }
  // SHOWING SUCCESS MESSAGE
  if (isset($_GET['order'])){
    ?>
    <script>
      alert("Order added Succesfully");
    </script>
    <?php
  }
?>
<html>
  <body>
    <div class="container">
      <div class="row">
        <form class="row row-cols-lg-auto g-3 justify-content-center" method="post" action="formsubmit.php">
          <div class="col-12">
            <div class="input-group">
              <input
              type="number"
              class="form-control"
              name="units"
              id="units"
              min="10"
              placeholder="Units"
              required
              />
              <div class="input-group-text">Units</div>
            </div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-danger"> Add Donation</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
  include 'footer.html';
?>