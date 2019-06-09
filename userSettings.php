<?php
include "connect.php";

session_start();

if (
  isset($_SESSION["username"]) &&
  isset($_POST["new_password"]) &&
  isset($_POST["gender"]) &&
  isset($_POST["city"]) &&
  isset($_POST["birthday"]) &&
  isset($_POST["education"]) &&
  isset($_POST["difficulty"]) &&
  isset($_POST["old_password"]) 
) {
  $username = mysqli_real_escape_string($link, $_SESSION['username']);
  $password = mysqli_real_escape_string($link, $_POST['old_password']);

  $query = "SELECT 1 FROM user WHERE username='$username' and password='$password'";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $count = mysqli_num_rows($result);

  if ($count != 1) {
    echo("Wrong password :'(");
    exit();
  }

  $flag = false;
  $query = "UPDATE user SET ";

  $new_password = mysqli_real_escape_string($link, $_POST['new_password']);
  if (!empty($new_password)) {
    $query = $query."password = '$new_password', ";
    $flag = true;
  }

  $gender = mysqli_real_escape_string($link, $_POST['gender']);
  if (!empty($gender)) {
    $query = $query."gender = '$gender', ";
    $flag = true;
  }

  $city = mysqli_real_escape_string($link, $_POST['city']);
  if (!empty($city)) {
    $query = $query."city = '$city', ";
    $flag = true;
  }

  $birthday = mysqli_real_escape_string($link, $_POST['birthday']);
  if (!empty($birthday)) {
    $query = $query."birthdate = '$birthday', ";
    $flag = true;
  }

  $education = mysqli_real_escape_string($link, $_POST['education']);
  if (!empty($education)) {
    $query = $query."education = '$education', ";
    $flag = true;
  }

  $difficulty = mysqli_real_escape_string($link, $_POST['difficulty']);
  if (!empty($difficulty)) {
    $query = $query."difficulty = '$difficulty', ";
    $flag = true;
  }

  if (!$flag) {
    echo ("No data was sent to be updated");
    exit();
  }

  if (substr($query, -2) == ", ") $query = substr($query, 0, -2);
  $query = $query." WHERE username='$username'";

  mysqli_autocommit($link, false);

  $result = mysqli_query($link, $query) or die(mysqli_error($link));

  if ($result) {
    mysqli_commit($link);
    echo ("Success");
  } else {
    mysqli_rollback($link);
    echo ("Could not submit to DB, sorry :'(");
  }
} elseif (isset($_SESSION["username"])) {
  $username = mysqli_real_escape_string($link, $_SESSION['username']);

  $query = "SELECT * FROM user WHERE username='$username'";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $row=mysqli_fetch_array($result);
  ?>

  <link rel="stylesheet" type="text/css" href="css/settings.css">

  <div class="container">
    <div class="card-body">
      <h1 class="card-title text-center"><?php echo $_SESSION['username'];?> Information</h1>
      <br>
      <div class="form-signin">
        <div class="form-row form-label">
          <div class="custom-control custom-checkbox my-3 ml-3">
            <input type="checkbox" class="custom-control-input" id="change_password" onclick="pass()">
            <label class="custom-control-label" for="change_password">Change Password</label>
          </div>

          <div class="form-label-group col">
            <input type="password" id="new_password" class="form-control" disabled=true placeholder="New Password" required>
            <label for="new_password">New Password</label>
          </div>

          <div class="form-label-group col">
            <input type="password" id="conf_password" class="form-control" disabled=true placeholder="Confirm Password" required>
            <label for="conf_password">Confirm New Password</label>
          </div>

        </div>

        <div class="form-label-group">
          <input type="gender" id="gender" class="form-control" placeholder="Gender" required autofocus
          value="<?php echo $row["gender"]; ?>">
          <label for="gender">Gender</label>
        </div>

        <div class="form-label-group">
          <input type="city" id="city" class="form-control" placeholder="City" required autofocus
          value="<?php echo $row["city"]; ?>">
          <label for="city">City</label>
        </div>

        <div class="form-label-group">
          <input type="birthday" id="birthday" class="form-control datetime" placeholder="Birthday" required autofocus
          value="<?php echo $row["birthdate"]; ?>">
          <label for="birthday">Birthday</label>
        </div>

        <div class="form-label-group">
          <input type="education" id="education" class="form-control" placeholder="Education" required autofocus
          value="<?php echo $row["education"]; ?>">
          <label for="education">Education</label>
        </div>

        <div class="form-label-group text-center" id="difficulty">

          <div class="custom-control custom-control-inline">
            <label>Select difficulty:</label>
          </div>

          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="difficulty1" name="difficulty"
            <?php if ($row["difficulty"] == 1) echo 'checked="true"';?>>
            <label class="custom-control-label" for="difficulty1">Easy</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="difficulty2" name="difficulty"
            <?php if ($row["difficulty"] == 2) echo 'checked="true"';?>>
            <label class="custom-control-label" for="difficulty2">Intermediate</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="difficulty3" name="difficulty"
            <?php if ($row["difficulty"] == 3) echo 'checked="true"';?>>
            <label class="custom-control-label" for="difficulty3">Advanced</label>
          </div>

          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="difficulty4" name="difficulty"
            <?php if ($row["difficulty"] == 4) echo 'checked="true"';?>>
            <label class="custom-control-label" for="difficulty4">Gradual (Easy - Intermediate)</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="difficulty5" name="difficulty"
            <?php if ($row["difficulty"]== 5) echo 'checked="true"';?>>
            <label class="custom-control-label" for="difficulty5">Gradual (Easy - Advanced)</label>
          </div>
        </div>

        <div id="error" class="form-label-group text-center">
        </div>

        <div class="form-label-group">
          <input type="password" id="old_password" class="form-control" placeholder="Password" required autofocus>
          <label for="old_password">Confirm Current Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" onclick="updateProfile()">Update Info</button>
      </div>
    </div>
  </div>

<?php
} else {
  header("Location: index.php");
}
?>

