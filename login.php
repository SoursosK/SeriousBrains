<?php
include "connect.php";

session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    $sql = "SELECT 1 FROM user WHERE username='$username' and password='$password'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['username'] = $username;
        echo("Success");
    } else {
        echo("Wrong Credentials");  
    }

} elseif (isset($_SESSION["username"])){
    header("Location: index.php");
} else {
?>

<link rel="stylesheet" type="text/css" href="./css/login.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <div class="form-signin">
              <div class="form-label-group">
                <input type="username" id="username" class="form-control" placeholder="Username" required autofocus>
                <label for="username">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
              </div>

              <div id="error" class="form-label-group text-center" style="color:red;">
              </div>
              <button class="btn btn-lg btn-primary btn-block" onclick="checkCredentials()">Sign in</button>
              <hr class="my-4">
              <button class="btn btn-lg btn-secondary btn-block" onclick="location.href='register.php'">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  function checkCredentials() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var response = this.responseText.trim();
        if (response == "Success") {
          location.href = '.';
        } else {
            document.getElementById("error").innerHTML = response;
        }
      }
    };

    xhttp.open("POST", "login.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username + "&password=" + password);
  }
</script>

<?php
}
?>