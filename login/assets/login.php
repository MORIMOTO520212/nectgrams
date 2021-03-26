<?php
// MySQL オブジェクト指向
//
//    [挿入]
//    INSERT INTO テーブル名 VALUES("", ""・・・);
//    [指定して抽出]
//    SELECT * FROM テーブル名 WHERE カラム名="文字列(完全一致)";
//
// 接続する
require "../../container/connect_mysql_users.php";

$userData = array(); // ユーザーデータ

// データベース表示
while($row = $result->fetch_row()){
    $userData[] = $row;
}

/* ID PASS LOGIN */
if("form" == $_POST["type"]){
    $form_id = $_POST["id"];
    $pass_hash = $_POST["pass_hash"];
    foreach($userData as $user){ // id - $user[0], pass_hash - $user[1], gsh - $user[2], mid - $user[3]
        $sql_id        = $user[0];
        $sql_pass_hash = $user[1];
        $sql_mid       = $user[3];
        if($form_id == $sql_id && $pass_hash == $sql_pass_hash) echo $sql_mid;
    }
}
/* GOOGLE SIGNIN LOGIN */
if("g_signin" == $_POST["type"]){
    $form_gsh = $_POST["g_signin_hash"];
    foreach($userData as $user){
        $sql_gsh = $user[2];
        $sql_mid  = $user[3];
        if($sql_gsh == $form_gsh) echo $sql_mid;
    }
}

// 終了
$mysqli->close();
?>