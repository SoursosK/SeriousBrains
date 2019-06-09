<?php
include "connect.php";

session_start();

$query = "select difficulty from user where username = '".$_SESSION["username"]."'"; 
$result = mysqli_query($link, $query); 
$level = mysqli_fetch_array($result)[0];

?>

<div>
    <h2>Maze Game</h2>
    <p>
        Welcome!<br />
        This is the Maze Game.

    </p>
    <div>
        <button class="btn-init" <?php echo 'onclick="map'.$level.'()"';?>>Play</button>
    </div>
    <canvas width="616" height="556" id="mazecanvas">Can't load the maze game, because your browser doesn't support HTML5.</canvas>
</div>