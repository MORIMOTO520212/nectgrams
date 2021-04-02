<?php
require "../../container/connect_mysql_users.php";

$mid = $_POST["mid"];
$gsh = $_POST["g_signin_hash"];

$res_mid = $mysqli->query("SELECT * FROM users WHERE mid LIKE '$mid'");
$user = array();
$user = $res_mid->fetch_row();
$res = "failed";
if(!$user[2]){ //submit.
    $mysqli->query("UPDATE users SET gsh='$gsh' WHERE mid LIKE '$mid'");
    $res = "completed";
}else{ // gsh existed.
    $res = "existed";
}

$mysqli->close();

echo $res;
?>