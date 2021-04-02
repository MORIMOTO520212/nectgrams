<?php
require "../../container/connect_mysql_users.php";

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
    $form_gsh = $_POST["g_signin_hash"];
    $userData = $mysqli->query("SELECT * FROM users WHERE gsh='$form_gsh'")->fetch_row();
    if($userData){
        $mysqli->close();
        echo $userData[3];
    }else{
        $mysqli->close();
        echo false;
    }
}
?>