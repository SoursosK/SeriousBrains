<?php
include "connect.php";

session_start();

if (isset($_SESSION["username"])) {


?>


<h2>Games Statistics</h2>
<div class="table-responsive">

    <table class="table table-striped table-sm">
        <tr>
            <th colspan="2">Game</th>
            <td><i>Sound Matching</i></td>
            <td><i>Find the odd one out</i></td>
            <td><i>Maze game</i></td>
            <td><i>Card game</i></td>
        </tr>
        <tr>
            <td rowspan="5"><b>Success/Level</b></td>
            <td><b>Easy</b></td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
        </tr>
        <tr>
            <td><b>Intermediate</b></td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
        </tr>
        <tr>
            <td><b>Advanced</b></td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
        </tr>
        <tr>
            <td><b>Gradual (Easy-Intermediate)</b></td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
        </tr>
        <tr>
            <td><b>Gradual (Easy-Advanced)</b></td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
        </tr>

        <tr>
            <td rowspan="5"><b>Failure/Level</b></td>
            <td><b>Easy</b></td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
        </tr>
        <tr>
            <td><b>Intermediate</b></td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
        </tr>
        <tr>
            <td><b>Advanced</b></td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
        </tr>
        <tr>
            <td><b>Gradual (Easy-Intermediate)</b></td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
        </tr>
        <tr>
            <td><b>Gradual (Easy-Advanced)</b></td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
        </tr>

        <tr>
            <td rowspan="5"><b>Abort/Level</b></td>
            <td><b>Easy</b></td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
            <td>15</td>
        </tr>
        <tr>
            <td><b>Intermediate</b></td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
            <td>12</td>
        </tr>
        <tr>
            <td><b>Advanced</b></td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
        </tr>
        <tr>
            <td><b>Gradual (Easy-Intermediate)</b></td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
            <td>11</td>
        </tr>
        <tr>
            <td><b>Gradual (Easy-Advanced)</b></td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
        </tr>

        <tr>
            <th colspan="2">Minutes of gameplay</th>
            <td>5</td>
            <td>5</td>
            <td>5</td>
            <td>5</td>
        </tr>
        <tr>
            <th colspan="2">Different days of gameplay</th>
            <td>4</td>
            <td>4</td>
            <td>4</td>
            <td>4</td>
        </tr>
        <tr>
            <th colspan="2">Points</th>
            <td>40</td>
            <td>40</td>
            <td>40</td>
            <td>40</td>
        </tr>
        <tr>
            <th colspan="2">% Accuracy</th>
            <td>60</td>
            <td>60</td>
            <td>60</td>
            <td>60</td>
        </tr>
    </table>
</div>

<?php
} else {
    header("Location: index.php");
}
?>