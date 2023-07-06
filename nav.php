<?php
ob_start();
error_reporting(E_ERROR | E_PARSE);
session_start();
//INPUT CLEANING FUNCTION
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>No Hunger Org</title>
    <link
      rel="canonical"
      href="https://v5.getbootstrap.com/docs/5.0/examples/product/"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
      integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
      crossorigin="anonymous"
    />
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
      integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
  </head>
  <style>

    nav,
    nav a,
    nav a:hover ,li a:hover, li a{
      color: white;
    }
    body{
      background:whitesmoke;
    }
  </style>
  <body>
    <nav class="navbar navbar-expand-lg bg-danger">
      <div class="container-fluid">
        <span class="navbar-brand">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="bi bi-droplet-fill"
            viewBox="0 0 16 16"
          >
            <path
              d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z"
            />
          </svg>
          No Hunger org
        </span>
        <ul class="nav justify-content-end d-md-non">
        <i class="material-icons">person</i>
          <li class="nav-item">
          
          <span class="navbar-text"> 
          
            <?php 
             if (isset($_SESSION["name"])){
                echo $_SESSION["name"].' '.$_SESSION['type'];
              }
            ?>
          </span>
          </li>
        </ul>
      </div>
    </nav>

  <ul class="nav justify-content-center bg-danger sticky-top">
    <li class="nav-item">
    
      <a class="nav-link" aria-current="page" href="index.php"> Home</a>
    </li>
    <?php
    // FOR donor USERS
      if (isset($_SESSION["name"]) and isset($_SESSION["type"])) {
        if ($_SESSION["type"]=='donor'){
    ?>
            <li class="nav-item">
              <a class="nav-link" href="requests.php">Requests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="adddonation.php">Add Donation</a>
            </li>
          <?php
            }
            else{
              ?>
              <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
              </li>
              <?php
            }
          ?>
      <li class="nav-item">
        <a class="nav-link" href="notifications.php">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>
    <?php
      }
      // FOR GUEST VISITORS
      else{
    ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Log in</a>
      </li>
    <?php
      }
    ?>
  </ul>
  <br>
  </body>
</html>

<script>

function notify() {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        var x=this.responseText;
        alert(x);
    }
  xmlhttp.open("POST", "notifybk.php");
  xmlhttp.send();
  }
//notify();

</script>