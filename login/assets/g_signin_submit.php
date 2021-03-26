<?php
require "../../container/connect_mysql_users.php";

$userData = array(); // ユーザーデータ

// データベース表示
while($row = $result->fetch_row()){
    $userData[] = $row;
}

$mid = "nersha371plb";
$res_mid = $mysqli->query("SELECT * FROM users WHERE mid LIKE '$mid'");

var_dump($res_mid);
$user = array();
$user = $res_mid->fetch_row();
var_dump($user);


// $_POST["g_signin_hash"]

// 終了
$mysqli->close();
?>