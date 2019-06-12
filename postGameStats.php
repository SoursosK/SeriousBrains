<?php
include "connect.php";

session_start();

if (
    isset($_POST["gameid"]) &&
    isset($_POST["hit"]) &&
    isset($_POST["miss"]) &&
    isset($_POST["quit"]) &&
    isset($_POST["score"]) &&
    isset($_POST["accuracy"]) &&
    isset($_POST["avgspeed"]) &&
    isset($_POST["playtime"]) &&
    isset($_POST["starttimestamp"]) &&
    isset($_POST["endtimestamp"])
) {
    $gameid = mysqli_real_escape_string($link, $_POST['gameid']);

    $query = "select userid from user where username = '".$_SESSION["username"]."'";
    $result = mysqli_query($link, $query);
    $userid = mysqli_fetch_array($result)[0];

    $hit = mysqli_real_escape_string($link, $_POST['hit']);
    $miss = mysqli_real_escape_string($link, $_POST['miss']);
    $quit = mysqli_real_escape_string($link, $_POST['quit']);
    $score = mysqli_real_escape_string($link, $_POST['score']);
    $accuracy = mysqli_real_escape_string($link, $_POST['accuracy']);
    $avgspeed = mysqli_real_escape_string($link, $_POST['avgspeed']);
    $playtime = mysqli_real_escape_string($link, $_POST['playtime']);

    $query = "select difficulty from user where username = '".$_SESSION["username"]."'";
    $result = mysqli_query($link, $query);
    $level = mysqli_fetch_array($result)[0];

    $starttimestamp = mysqli_real_escape_string($link, $_POST['starttimestamp']);
    $endtimestamp = mysqli_real_escape_string($link, $_POST['endtimestamp']);
}

// if (empty($gameid) || empty($userid) || empty($hit) || empty($miss) || empty($quit) || empty($score) || empty($accuracy) || empty($avgspeed) || empty($playtime) || empty($level) || empty($starttimestamp) || empty($endtimestamp)) {
    
//     echo($gameid); echo(' '); echo($userid); echo(' '); echo($hit); echo(' '); echo($miss); echo(' '); echo($quit); echo(' '); echo($score); echo(' '); echo($accuracy); echo(' '); echo($avgspeed); echo(' '); echo($playtime); echo(' '); echo($level); echo(' '); echo($starttimestamp); echo(' '); echo($endtimestamp);
//     echo "All the fields need to be completed.";
//     exit();
// }

$query = "INSERT INTO gameevent (gameid, userid, hit, miss, quit, score, accuracy, avgspeed, playtime, level, starttimestamp, endtimestamp ) VALUES ('$gameid', '$userid', '$hit', '$miss', '$quit', '$score', '$accuracy',  '$avgspeed',  '$playtime',  '$level',  '$starttimestamp',  '$endtimestamp');";
mysqli_query($link, $query);

?>
