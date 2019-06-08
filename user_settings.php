<?php
include "connect.php";

session_start();

// $query = "select * from user where username='".$_SESSION['username']."'";
// $result = mysqli_query($link, $query) or die(mysqli_error($link));
// $count = mysqli_num_rows($result);

// if ($count == 1) {
//         $row = mysqli_fetch_assoc($result);
//         $gender = $row['gender'];
// }


// mysqli_autocommit($link, false);
// $query = "";

// if (!empty($_POST["gender"])){
//     $query = "update user set gender=''$_POST["gender"]'' where username=''$_POST["username"]''"; 
// }
// if (!empty($_POST["city"])){
//     $query = "update user set city=''$_POST["city"]'' where username=''$_POST["username"]''"; 
// }
// if (!empty($_POST["birthdate"])){
//     $query = "update user set birthdate=''$_POST["birthdate"]'' where username=''$_POST["username"]''"; 
// }
// if (!empty($_POST["education"])){
//     $query = "update user set education=''$_POST["education"]'' where username=''$_POST["username"]''"; 
// }
// if (!empty($_POST["difficulty"])){
//     $query = "update user set difficulty=''$_POST["difficulty"]'' where username=''$_POST["username"]''"; 
// }

// $result = mysqli_query($link, $query);

//     if ($result) {
//         mysqli_commit($link);
//         send_message('Τα στοιχεία σας καταχωρήθηκαν με επιτυχία.', 'success');
//         header(" Location: index . php ");
//         exit();
//     } else {
//         mysqli_rollback($link);
//         send_message('Τα στοιχεία δεν καταχωρήθηκαν λόγω προβλήματος στην βάση του συστήματος.', 'error');
//     }

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
  $username = mysqli_real_escape_string($link, $_SESSION['username']);

  $sql = "SELECT * FROM user WHERE username='$username'";
  $result = mysqli_query($link, $sql) or die(mysqli_error($link));
  $row=mysqli_fetch_array($result);
  ?>

  <link rel="stylesheet" type="text/css" href="css/settings.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

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
            <label class="custom-control-label" for="difficulty4">Gradual (Easy - Advanced)</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="difficulty5" name="difficulty"
            <?php if ($row["difficulty"]== 5) echo 'checked="true"';?>>
            <label class="custom-control-label" for="difficulty5">Gradual (Easy - Intermediate)</label>
          </div>
        </div>

        <div id="error" class="form-label-group text-center" style="color:red;">
        </div>

        <div class="form-label-group">
          <input type="password" id="password" class="form-control" placeholder="Password" required>
          <label for="password">Confirm Current Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" onclick="registerCredentials()">Update Info</button>
      </div>
    </div>
  </div>

<?php
} else {
  header("Location: index.php");
}
?>