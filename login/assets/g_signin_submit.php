<?php
require "../../container/connect_mysql_users.php";

$userData = array(); // ユーザーデータ

// データベース表示
while($row = $result->fetch_row()) $userData[] = $row;


$mid = $_POST["mid"];
$gsh = $_POST["g_signin_hash"];

$res_mid = $mysqli->query("SELECT * FROM users WHERE mid LIKE '$mid'");
$user = array();
$user = $res_mid->fetch_row();
$res = "";
if(!$user[2]){ //submit.
    $res = $mysqli->query("UPDATE users SET gsh='$gsh' WHERE mid LIKE '$mid'");
}else{ // gsh existed.
    $res = "existed";
}

// 終了
$mysqli->close();

return $res;
?>