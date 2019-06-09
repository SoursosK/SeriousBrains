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
  <link rel='icon' href='favicon.ico' type='image/x-icon' />
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
        <a class="list-group-item list-group-item-action bg-light" onclick="FindTheOddOneOut()">Find The Odd One Out</a>
        <a class="list-group-item list-group-item-action bg-light" onclick="Maze()">Maze</a>
        <a class="list-group-item list-group-item-action bg-light" onclick="SoundMatching()">Sound Matching</a>
        <a class="list-group-item list-group-item-action bg-light" onclick="MatchingCards()">Puzzle</a>
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
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="review()">Review Website</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="showStatistics()">Statistics</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid" id="content">
        <h1 class="mt-4">Welcome to Serious Brains!</h1>
        <p>You can choose which game you want to play from the Games Menu.</p>
        <p>If you ever want to change your profile settings, view your statistics or rate our platform, <br>be sure to check the drop down menu under your name at the top right corner!</p>
        <br>
        <h1 class="mt-4">Game Instructions:</h1>
        <h2 class="mt-4">Find The Odd One Out:</h2>
        <p>The aim of the Puzzle game is to place the fragmented image back to it's former state. Depending on the difficulty level, the image may be broken up to 4, 6 or 8 pieces.<br>
           Please choose the piece you want to place first, and then click the destination square. You will have 2 and a half minutes to complete the game.
        </p>
        <h2 class="mt-4">Labyrinth:</h2>
        <p>
          The aim of the Labyrinth game is to move the blue square and reach the green circle, following the correct path through the maze. Depending on the difficulty level,<br>
          the labyrinth's complexity may be higher. You can move the blue square using the arrow keys. Yoy will have 1 minute and a half to complete the game.
        </p>
        <h2 class="mt-4">Matching Sounds:</h2>
        <p>
          The aim of the MatchingSounds game is to choose the image, to which the sound playing belongs to. Depending on the difficylty level,<br>
          the images from which you will have to choose from increase. You will have 30 seconds to complete the game.
        </p>
        <h2 class="mt-4">Puzzle Game:</h2>
        <p>
          The aim of the Puzzle game is to place the fragmented image back to it's former state. Depending on the difficulty level, the image may be broken up to 4, 6 or 8 pieces.<br> 
          Please choose the piece you want to place first, and then click the destination square. You will have 2 and a half minutes to complete the game.
        </p>
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


  <!-- Requirements for the FindTheOddOneOut Game -->
  <script src="http://localhost/SeriousBrains/Games/Find the Odd One Out/functions.js"></script>


  <!-- Requirements for the Maze Game -->
  <script src="http://localhost/SeriousBrains/Games/Maze/maps.js"></script>


  <!-- Requirements for the SoundMatching Game -->

  <script src="http://localhost/SeriousBrains/Games/Sound Matching/functions2.js"></script>

  
  <script src="Games/Puzzle/js/image-puzzle.js"></script>



  <!-- Moment.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

  <!-- moment-duration-format plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/1.3.0/moment-duration-format.min.js"></script>



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


  <!-- Content AJAX filling -->
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
    function FindTheOddOneOut() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "FindTheOddOneOut.html", true);
      xhttp.send();
    }
  </script>

  <script>
    function Maze() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "Maze.php", true);
      xhttp.send();
    }
  </script>

  <script>
    function MatchingCards() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "MatchingCards.php", true);
      xhttp.send();
    }
  </script>

  <script>
    function SoundMatching() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "SoundMatching.html", true);
      xhttp.send();
    }
  </script>

  <script>
    function showStatistics() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content").innerHTML = this.responseText;
        }
      };

      xhttp.open("GET", "statistics.php", true);
      xhttp.send();
    }
  </script>

  <!-- AJAX Post Requests -->
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

  <!-- AJAX Get Requests -->
</body>

</html>

<script>
  function postGameStats(gameid, hit, miss, quit, score, accuracy, avgspeed, playtime, starttimestamp, endtimestamp) {
    var xhttp = new XMLHttpRequest();

    // console.log(hit, miss, quit, score, accuracy, avgspeed, playtime, starttimestamp, endtimestamp);

    // xhttp.onreadystatechange = function() {
    //   if (this.readyState == 4 && this.status == 200) {
    //     console.log(this.responseText);

    //   }
    // };

    xhttp.open("POST", "postGameStats.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("gameid=" + gameid + "&hit=" + hit + "&miss=" + miss + "&quit=" + quit + "&score=" + score + "&accuracy=" + accuracy + "&avgspeed=" + avgspeed + "&playtime=" + playtime + "&starttimestamp=" + starttimestamp + "&endtimestamp=" + endtimestamp);
  }

  function stop(gameid){
    postGameStats(gameid, 0, 0, 1, 0, 0, 0, 0, 0, 0);
    header("Location: login.php");
  }
</script>