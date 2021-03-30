<?php
function sessionCheck($mysqli) {
    // user session
    $session = 0;
    $mid = ""; // ログインしてない場合  
    foreach($_COOKIE as $key => $value){ // cookie確認と取得
        if("session" == $key){
            $mid = $_COOKIE["session"];
        }
    }
    if($mysqli->query("SELECT mid FROM users WHERE mid='$mid'")->fetch_row()){
        $session = 1;
    }
    return $session;
}
?>