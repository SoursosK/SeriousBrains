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
                <a class="dropdown-item" onclick="userSettings()">User Settings</a>
                <a class="dropdown-item" onclick="review()">Review Website</a>
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
    function userSettings() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
          $(".datetime").datepicker({
            format: 'yyyy-mm-dd'
          });
        }
      };

      xhttp.open("GET", "userSettings.php", true);
      xhttp.send();
    }
  </script>

  <script>
    function review() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "review.php", true);
      xhttp.send();
    }
  </script>

  <script>
    function updateProfile() {
      if (document.getElementById("new_password").value != document.getElementById("conf_password").value) {
        document.getElementById("error").innerHTML = "Passwords do not match!!";
        return;
      }

      var new_password = document.getElementById("new_password").value;
      var gender = document.getElementById("gender").value;
      var city = document.getElementById("city").value;
      var birthday = document.getElementById("birthday").value;
      var education = document.getElementById("education").value;
      var difficulty;
      if (document.getElementById("difficulty1").checked) difficulty = 1;
      else if (document.getElementById("difficulty2").checked) difficulty = 2;
      else if (document.getElementById("difficulty3").checked) difficulty = 3;
      else if (document.getElementById("difficulty4").checked) difficulty = 4;
      else if (document.getElementById("difficulty5").checked) difficulty = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid difficulty!!";
        return;
      }
      var old_password = document.getElementById("old_password").value;

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("error").innerHTML = this.responseText;
          if (document.getElementById("error").innerHTML.trim() == "Success")
            document.getElementById("error").style.color = "LimeGreen";
          else
            document.getElementById("error").style.color = "Red";
        }
      };

      xhttp.open("POST", "userSettings.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("new_password=" + new_password + "&gender=" + gender + "&city=" + city + "&birthday=" + birthday + "&education=" + education + "&difficulty=" + difficulty + "&old_password=" + old_password);
    }
  </script>

<script>
    function submitReview() {
      var q1;
      if (document.getElementById("q11").checked) q1 = 1;
      else if (document.getElementById("q12").checked) q1 = 2;
      else if (document.getElementById("q13").checked) q1 = 3;
      else if (document.getElementById("q14").checked) q1 = 4;
      else if (document.getElementById("q15").checked) q1 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q2;
      if (document.getElementById("q21").checked) q2 = 1;
      else if (document.getElementById("q22").checked) q2 = 2;
      else if (document.getElementById("q23").checked) q2 = 3;
      else if (document.getElementById("q24").checked) q2 = 4;
      else if (document.getElementById("q25").checked) q2 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q3;
      if (document.getElementById("q31").checked) q3 = 1;
      else if (document.getElementById("q32").checked) q3 = 2;
      else if (document.getElementById("q33").checked) q3 = 3;
      else if (document.getElementById("q34").checked) q3 = 4;
      else if (document.getElementById("q35").checked) q3 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q4;
      if (document.getElementById("q41").checked) q4 = 1;
      else if (document.getElementById("q42").checked) q4 = 2;
      else if (document.getElementById("q43").checked) q4 = 3;
      else if (document.getElementById("q44").checked) q4 = 4;
      else if (document.getElementById("q45").checked) q4 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q5;
      if (document.getElementById("q51").checked) q5 = 1;
      else if (document.getElementById("q52").checked) q5 = 2;
      else if (document.getElementById("q53").checked) q5 = 3;
      else if (document.getElementById("q54").checked) q5 = 4;
      else if (document.getElementById("q55").checked) q5 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q6;
      if (document.getElementById("q61").checked) q6 = 1;
      else if (document.getElementById("q62").checked) q6 = 2;
      else if (document.getElementById("q63").checked) q6 = 3;
      else if (document.getElementById("q64").checked) q6 = 4;
      else if (document.getElementById("q65").checked) q6 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q7;
      if (document.getElementById("q71").checked) q7 = 1;
      else if (document.getElementById("q72").checked) q7 = 2;
      else if (document.getElementById("q73").checked) q7 = 3;
      else if (document.getElementById("q74").checked) q7 = 4;
      else if (document.getElementById("q75").checked) q7 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q8;
      if (document.getElementById("q81").checked) q8 = 1;
      else if (document.getElementById("q82").checked) q8 = 2;
      else if (document.getElementById("q83").checked) q8 = 3;
      else if (document.getElementById("q84").checked) q8 = 4;
      else if (document.getElementById("q85").checked) q8 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q9;
      if (document.getElementById("q91").checked) q9 = 1;
      else if (document.getElementById("q92").checked) q9 = 2;
      else if (document.getElementById("q93").checked) q9 = 3;
      else if (document.getElementById("q94").checked) q9 = 4;
      else if (document.getElementById("q95").checked) q9 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var q10;
      if (document.getElementById("q101").checked) q10 = 1;
      else if (document.getElementById("q102").checked) q10 = 2;
      else if (document.getElementById("q103").checked) q10 = 3;
      else if (document.getElementById("q104").checked) q10 = 4;
      else if (document.getElementById("q105").checked) q10 = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid arguments!!";
        return;
      }

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("error").innerHTML = this.responseText;
          if (document.getElementById("error").innerHTML.trim() == "Success")
            document.getElementById("error").style.color = "LimeGreen";
          else
            document.getElementById("error").style.color = "Red";
        }
      };

      xhttp.open("POST", "review.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("q1=" + q1 + "&q2=" + q2 + "&q3=" + q3 + "&q4=" + q4 + "&q5=" + q5 + "&q6=" + q6 + "&q7=" + q7 + "&q8=" + q8 + "&q9=" + q9 + "&q10=" + q10);
    }
  </script>

</body>

</html>