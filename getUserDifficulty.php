<?php
include "connect.php";

session_start();

$query = "select difficulty from user where username = '".$_SESSION["username"]."'"; 
$result = mysqli_query($link, $query); 
$level = mysqli_fetch_array($result)[0];

echo $level;
?>