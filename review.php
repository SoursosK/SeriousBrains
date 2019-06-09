<?php
include "connect.php";

session_start();

if (
  isset($_SESSION['loginid']) &&
  isset($_SESSION["username"]) &&
  isset($_POST["q1"]) &&
  isset($_POST["q2"]) &&
  isset($_POST["q3"]) &&
  isset($_POST["q4"]) &&
  isset($_POST["q5"]) &&
  isset($_POST["q6"]) &&
  isset($_POST["q7"]) &&
  isset($_POST["q8"]) &&
  isset($_POST["q9"]) &&
  isset($_POST["q10"])
) {

  if (
    $_POST["q1"] < 1 ||
    $_POST["q1"] > 5 ||
    $_POST["q2"] < 1 ||
    $_POST["q2"] > 5 ||
    $_POST["q3"] < 1 ||
    $_POST["q3"] > 5 ||
    $_POST["q4"] < 1 ||
    $_POST["q4"] > 5 ||
    $_POST["q5"] < 1 ||
    $_POST["q5"] > 5 ||
    $_POST["q6"] < 1 ||
    $_POST["q6"] > 5 ||
    $_POST["q7"] < 1 ||
    $_POST["q7"] > 5 ||
    $_POST["q8"] < 1 ||
    $_POST["q8"] > 5 ||
    $_POST["q9"] < 1 ||
    $_POST["q9"] > 5 ||
    $_POST["q10"] < 1 ||
    $_POST["q10"] > 5
  ) {
    echo ("Invalid arguments!!");
    exit();
  }

  $loginid =  mysqli_real_escape_string($link, $_SESSION["loginid"]);
  $username = mysqli_real_escape_string($link, $_SESSION["username"]);
  $a1 = mysqli_real_escape_string($link, $_POST['q1']);
  $a2 = mysqli_real_escape_string($link, $_POST['q2']);
  $a3 = mysqli_real_escape_string($link, $_POST['q3']);
  $a4 = mysqli_real_escape_string($link, $_POST['q4']);
  $a5 = mysqli_real_escape_string($link, $_POST['q5']);
  $a6 = mysqli_real_escape_string($link, $_POST['q6']);
  $a7 = mysqli_real_escape_string($link, $_POST['q7']);
  $a8 = mysqli_real_escape_string($link, $_POST['q8']);
  $a9 = mysqli_real_escape_string($link, $_POST['q9']);
  $a10 = mysqli_real_escape_string($link, $_POST['q10']);

  $sql = "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (1, $a1, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (2, $a2, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (3, $a3, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (4, $a4, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (5, $a5, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (6, $a6, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (7, $a7, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (8, $a8, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (8, $a9, (SELECT userid FROM user WHERE username='$username'), $loginid);";
  $sql .= "INSERT INTO surveyanswer(qid, answer, userid, loginid) VALUES (10, $a10, (SELECT userid FROM user WHERE username='$username'), $loginid);";

  $flag = true;
  mysqli_autocommit($link, false);

  if (mysqli_multi_query($link, $sql)) {
    do {
      if (($result = mysqli_store_result($link)) === false && mysqli_error($link) != '') {
        $flag = false;
      }
    } while (mysqli_more_results($link) && mysqli_next_result($link));
  } else {
    $flag = false;
  }

  if ($flag) {
    mysqli_commit($link);
    echo ("Success");
  } else {
    mysqli_rollback($link);
    echo ("Could not submit to DB, sorry :'(");
  }
} elseif (isset($_SESSION["username"])) {
  ?>
  <link rel="stylesheet" type="text/css" href="css/settings.css">

  <div class="container">
    <div class="card-body">
      <h1 class="card-title text-center">Game Evaluation Form</h1>
      <br>
      <h4 class="card-title text-center">Please answer the questions about the usability of the games.<br>Respond by rating 1 to 5 where <b>1 means "I absolutely disagree" and 5 means "I absolutely agree"</b>.</h4>
      <br>
      <div class="form-signin">
        <div class="form-label-group text-center">
          <div>
            <label>1. I think I would like to use these games often.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q11" name="q1">
            <label class="custom-control-label" for="q11">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q12" name="q1">
            <label class="custom-control-label" for="q12">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q13" name="q1">
            <label class="custom-control-label" for="q13">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q14" name="q1">
            <label class="custom-control-label" for="q14">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q15" name="q1">
            <label class="custom-control-label" for="q15">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>2. I found these games unnecessarily complicated.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q21" name="q2">
            <label class="custom-control-label" for="q21">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q22" name="q2">
            <label class="custom-control-label" for="q22">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q23" name="q2">
            <label class="custom-control-label" for="q23">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q24" name="q2">
            <label class="custom-control-label" for="q24">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q25" name="q2">
            <label class="custom-control-label" for="q25">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>3. I thought these games were easy to use.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q31" name="q3">
            <label class="custom-control-label" for="q31">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q32" name="q3">
            <label class="custom-control-label" for="q32">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q33" name="q3">
            <label class="custom-control-label" for="q33">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q34" name="q3">
            <label class="custom-control-label" for="q34">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q35" name="q3">
            <label class="custom-control-label" for="q35">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>4. I think I will need some help from a specialist to be able to use these games.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q41" name="q4">
            <label class="custom-control-label" for="q41">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q42" name="q4">
            <label class="custom-control-label" for="q42">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q43" name="q4">
            <label class="custom-control-label" for="q43">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q44" name="q4">
            <label class="custom-control-label" for="q44">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q45" name="q4">
            <label class="custom-control-label" for="q45">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>5. I found the various functions in these games well integrated.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q51" name="q5">
            <label class="custom-control-label" for="q51">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q52" name="q5">
            <label class="custom-control-label" for="q52">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q53" name="q5">
            <label class="custom-control-label" for="q53">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q54" name="q5">
            <label class="custom-control-label" for="q54">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q55" name="q5">
            <label class="custom-control-label" for="q55">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>6. I thought there was a great inconsistency in the operation of the games.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q61" name="q6">
            <label class="custom-control-label" for="q61">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q62" name="q6">
            <label class="custom-control-label" for="q62">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q63" name="q6">
            <label class="custom-control-label" for="q63">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q64" name="q6">
            <label class="custom-control-label" for="q64">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q65" name="q6">
            <label class="custom-control-label" for="q65">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>7. I imagine most people will learn to use these games very quickly.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q71" name="q7">
            <label class="custom-control-label" for="q71">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q72" name="q7">
            <label class="custom-control-label" for="q72">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q73" name="q7">
            <label class="custom-control-label" for="q73">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q74" name="q7">
            <label class="custom-control-label" for="q74">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q75" name="q7">
            <label class="custom-control-label" for="q75">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>8. I found these toys very difficult / complicated to use.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q81" name="q8">
            <label class="custom-control-label" for="q81">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q82" name="q8">
            <label class="custom-control-label" for="q82">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q83" name="q8">
            <label class="custom-control-label" for="q83">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q84" name="q8">
            <label class="custom-control-label" for="q84">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q85" name="q8">
            <label class="custom-control-label" for="q85">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>9. I felt very confident using these games.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q91" name="q9">
            <label class="custom-control-label" for="q91">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q92" name="q9">
            <label class="custom-control-label" for="q92">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q93" name="q9">
            <label class="custom-control-label" for="q93">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q94" name="q9">
            <label class="custom-control-label" for="q94">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q95" name="q9">
            <label class="custom-control-label" for="q95">5</label>
          </div>
        </div>

        <div class="form-label-group text-center">
          <div>
            <label>10. I needed to know a lot of things before I could start with these games.</label>
          </div>
          <!-- Default inline 1-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q101" name="q10">
            <label class="custom-control-label" for="q101">1</label>
          </div>

          <!-- Default inline 2-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q102" name="q10">
            <label class="custom-control-label" for="q102">2</label>
          </div>

          <!-- Default inline 3-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" checked="true" class="custom-control-input" id="q103" name="q10">
            <label class="custom-control-label" for="q103">3</label>
          </div>
          <!-- Default inline 4-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q104" name="q10">
            <label class="custom-control-label" for="q104">4</label>
          </div>

          <!-- Default inline 5-->
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="q105" name="q10">
            <label class="custom-control-label" for="q105">5</label>
          </div>
        </div>
        <br>
        <div id="error" class="form-label-group text-center">
        </div>

        <button class="btn btn-lg btn-primary btn-block" onclick="submitReview()">Submit Review</button>
      </div>
    </div>
  </div>
<?php
} else {
  header("Location: index.php");
}
?>