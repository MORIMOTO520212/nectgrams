<?php
require "../../container/connect_mysql_users.php";
require_once "../../vendor/autoload.php";

$mid = $_POST["mid"];
$id_token = $_POST["g_signin_hash"];

$res_mid = $mysqli->query("SELECT * FROM users WHERE mid='$mid'");
$user = array();
$user = $res_mid->fetch_row();
$res = "";
if($user){ // register.
    if(!$user[2]){
        $client = new Google_Client(["client_id" => "602046748429-g7tk5ermd7p7vcksmt55eisldsnv51mh.apps.googleusercontent.com"]);
        $payload = $client->verifyIdToken($id_token);
        if($payload){
            $gsh = $payload["sub"];
            $mysqli->query("UPDATE users SET gsh='$gsh' WHERE mid='$mid'");
            $res = "completed";
        }else{ $res = "error_payload"; }
    }else{ $res = "existed"; }// registered.
}else{ $res = "failed"; }

$mysqli->close();

echo $res;
?>