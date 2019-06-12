<?php

include "connect.php";

session_start();

$query = "select difficulty from user where username = '".$_SESSION["username"]."'";
$result = mysqli_query($link, $query);
$level = mysqli_fetch_array($result)[0];

?>
<link href="Games/Puzzle/css/image-puzzle2.css" rel="stylesheet" />

<div id="collage">
    <h2>Image Puzzle</h2>
    <hr />
    <div id="play">
        <button type="button" onclick="start(<?php echo $level; ?>);">Play Again</button>
    </div>
    <div id="playPanel" style="padding:5px;display:none;">
        <h3 id="imgTitle"></h3>
        <hr />
        <div style="display:inline-block; margin:auto; width:95%; vertical-align:top;">
            <ul id="sortable" class="sortable"></ul>
            <div id="actualImageBox">
                <div id="timeBox">
                    Time Remained: <span id="timerPanel"></span> secs
                </div>
                <img id="actualImage" />
                <div>Re-arrange to create a picture like this.</div>
            </div>
        </div>
    </div>
    <div id="gameOver" style="display:none;">
        <div style="background-color: limegreen; padding: 5px 10px 20px 10px; text-align: center; ">
            <h2 style="text-align:center">Game Over!!</h2>
            Congratulations!! <br /> You have completed this picture.
            <br /> Time Remained: <span class="timeCount" id="timeCount">0</span>
            <br /> Points: <span class="points" id="points">0</span>
            <div>
                <button type="button" onclick="window.location.reload(true);">Play Again</button>
            </div>
        </div>

    </div>

    <div id="gameOver2" style="display:none;">
        <div style="background-color: #fc9e9e; padding: 5px 10px 20px 10px; text-align: center; ">
            <h2 style="text-align:center">Game Over!!</h2>
            Nice try!! <br />
            <div>
                <button type="button" onclick="window.location.reload(true);">Play Again</button>
            </div>
        </div>

    </div>
</div>