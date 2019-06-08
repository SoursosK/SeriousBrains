<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Serious Brains</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Serious Brains </div>
      <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a class="list-group-item list-group-item-action bg-light">Shortcuts</a>
        <a class="list-group-item list-group-item-action bg-light">Overview</a>
        <a class="list-group-item list-group-item-action bg-light">Events</a>
        <a class="list-group-item list-group-item-action bg-light">Profile</a>
        <a class="list-group-item list-group-item-action bg-light">Status</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Games Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username'] ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" onclick="user_settings()">User Settings</a>
                <a class="dropdown-item">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" id="content">
        <h1 class="mt-4">Simple Sidebar</h1>
        <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>. The top navbar is optional, and just for demonstration. Just create an element with the <code>#menu-toggle</code> ID which will toggle the menu when clicked.</p>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

  <script>
    function pass() {
      if (!document.getElementById('change_password').checked) {
        document.getElementById('new_password').disabled = true;
        document.getElementById('new_password').value = null;

        document.getElementById('conf_password').disabled = true;
        document.getElementById('conf_password').value = null;
      } else {
        document.getElementById('new_password').disabled = false;
        document.getElementById('conf_password').disabled = false;
      }
    }
  </script>

  <script>
    function user_settings() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
          $(".datetime").datepicker({
            format: 'yyyy-mm-dd'
          });
        }
      };

      xhttp.open("GET", "user_settings.php", true);
      xhttp.send();
    }
  </script>

</body>

</html>