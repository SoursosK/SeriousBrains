<?php
include "connect.php";

session_start();

if (
  isset($_POST["username"]) &&
  isset($_POST["password"]) &&
  isset($_POST["gender"]) &&
  isset($_POST["city"]) &&
  isset($_POST["birthday"]) &&
  isset($_POST["education"]) &&
  isset($_POST["difficulty"])
) {
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);
  $gender = mysqli_real_escape_string($link, $_POST['gender']);
  $city = mysqli_real_escape_string($link, $_POST['city']);
  $birthday = mysqli_real_escape_string($link, $_POST['birthday']);
  $education = mysqli_real_escape_string($link, $_POST['education']);
  $difficulty = mysqli_real_escape_string($link, $_POST['difficulty']);

  if (empty($username) || empty($password) || empty($gender) || empty($city) || empty($birthday) || empty($education) || empty($difficulty)) {
    echo ("Please complete all fields on the form");
    exit();
  }

  mysqli_autocommit($link, false);

  $sql = "INSERT INTO user (username, password, gender, city, birthdate, education, difficulty) VALUES ('$username', '$password', '$gender', '$city', '$birthday', '$education', $difficulty)";
  $result = mysqli_query($link, $sql);

  if ($result) {
    mysqli_commit($link);
    echo ("Success");
  } else {
    mysqli_rollback($link);
    echo ("Could not submit to DB, sorry :'(");
  }
} elseif (isset($_SESSION["username"])) {
  header("Location: index.php");
} else {
  ?>

  <link rel="stylesheet" type="text/css" href="./css/login.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Register</h5>
              <div class="form-signin">
                <div class="form-label-group">
                  <input type="username" id="username" class="form-control" placeholder="Username" required autofocus>
                  <label for="username">Username</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="password" class="form-control" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="conf_password" class="form-control" placeholder="Confirm Password" required>
                  <label for="conf_password">Confirm Password</label>
                </div>

                <div class="form-label-group">
                  <input type="gender" id="gender" class="form-control" placeholder="Gender" required autofocus>
                  <label for="gender">Gender</label>
                </div>

                <div class="form-label-group">
                  <input type="city" id="city" class="form-control" placeholder="City" required autofocus>
                  <label for="city">City</label>
                </div>

                <div class="form-label-group">
                  <input type="birthday" id="birthday" class="form-control datetime" placeholder="Birthday" required autofocus>
                  <label for="birthday">Birthday</label>
                </div>

                <div class="form-label-group">
                  <input type="education" id="education" class="form-control" placeholder="Education" required autofocus>
                  <label for="education">Education</label>
                </div>

                <div class="form-label-group" id="difficulty">

                  <div class="custom-control custom-control-inline">
                    <label>Select difficulty:</label>
                  </div>

                  <!-- Default inline 1-->
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" checked=true class="custom-control-input" id="difficulty1" name="difficulty">
                    <label class="custom-control-label" for="difficulty1">Easy</label>
                  </div>

                  <!-- Default inline 2-->
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="difficulty2" name="difficulty">
                    <label class="custom-control-label" for="difficulty2">Intermediate</label>
                  </div>

                  <!-- Default inline 3-->
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="difficulty3" name="difficulty">
                    <label class="custom-control-label" for="difficulty3">Advanced</label>
                  </div>

                  <!-- Default inline 4-->
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="difficulty4" name="difficulty">
                    <label class="custom-control-label" for="difficulty4">Gradual (Easy - Advanced)</label>
                  </div>

                  <!-- Default inline 5-->
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="difficulty5" name="difficulty">
                    <label class="custom-control-label" for="difficulty5">Gradual (Easy - Intermediate)</label>
                  </div>

                  <div id="error" class="form-label-group text-center" style="color:red;">
                  </div>

                  <button class="btn btn-lg btn-primary btn-block" onclick="registerCredentials()">Register</button>
                  <hr class="my-4">
                  <button class="btn btn-lg btn-secondary btn-block" onclick="location.href='login.php'">Sign in</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
    $(".datetime").datepicker({
      format: 'yyyy-mm-dd'
    });
  </script>

  <script>
    function registerCredentials() {
      if (document.getElementById("username").value.length == 0 ||
        document.getElementById("password").value.length == 0 ||
        document.getElementById("gender").value.length == 0 ||
        document.getElementById("city").value.length == 0 ||
        document.getElementById("birthday").value.length == 0 ||
        document.getElementById("education").value.length == 0) {
        document.getElementById("error").innerHTML = "Please complete all fields!!";
        return;
      }
      if (document.getElementById("password").value != document.getElementById("conf_password").value) {
        document.getElementById("error").innerHTML = "Passwords do not match!!";
        return;
      }
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      var gender = document.getElementById("gender").value;
      var city = document.getElementById("city").value;
      var birthday = document.getElementById("birthday").value;
      var education = document.getElementById("education").value;
      var difficulty;
      if (document.getElementById("difficulty1").checked) difficulty = 1;
      else if (document.getElementById("difficulty2").checked) difficulty = 2;
      else if (document.getElementById("difficulty3").checked) difficulty = 3;
      else if (document.getElementById("difficulty2").checked) difficulty = 4;
      else if (document.getElementById("difficulty3").checked) difficulty = 5;
      else {
        document.getElementById("error").innerHTML = "Invalid difficulty!!";
        return;
      }
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("error").innerHTML = this.responseText;
          if (document.getElementById("error").innerHTML.trim() == "Success") {
            location.href = '.';
          }
        }
      };

      xhttp.open("POST", "register.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("username=" + username + "&password=" + password + "&gender=" + gender + "&city=" + city + "&birthday=" + birthday + "&education=" + education + "&difficulty=" + difficulty);
    }
  </script>

<?php
}
?>