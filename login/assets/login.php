<?php
require "../../container/connect_mysql_users.php";
require_once "../../vendor/autoload.php";

/* ID PASS LOGIN */
if("form" == $_POST["type"]){
    $form_id = $_POST["id"];
    $pass_hash = $_POST["pass_hash"];
    $userData = $mysqli->query("SELECT * FROM users WHERE id='$form_id'")->fetch_row();
    $sql_pass_hash = $userData[1];
    $sql_mid = $userData[3];
    if($pass_hash == $sql_pass_hash){
        $mysqli->close();
        echo $sql_mid;
    }
}

/* GOOGLE SIGNIN LOGIN */
if("g_signin" == $_POST["type"]){
    $id_token = $_POST["g_signin_hash"];
    $client = new Google_Client(["client_id" => "602046748429-g7tk5ermd7p7vcksmt55eisldsnv51mh.apps.googleusercontent.com"]);
    $payload = $client->verifyIdToken($id_token);
    if($payload){
        $gsh = $payload["sub"];
        $userData = $mysqli->query("SELECT * FROM users WHERE gsh='$gsh'")->fetch_row();
        if($userData){
            $mysqli->close();
            echo $userData[3]; // mid
        }else{
            $mysqli->close();
            echo false;
        }
    }else{
        echo false;
    }
}


