<?php
function sessionCheck($userData) {
    // user session
    $session = 0;
    $userSession = ""; // ログインしてない場合  
    foreach($_COOKIE as $key => $value){ // cookie確認と取得
        if("session" == $key){
            $userSession = $_COOKIE["session"];
        }
    }
    foreach($userData as $user){
        $sql_mid = $user[3];
        if($userSession == $sql_mid) $session = 1;
    }
    return $session;
}
?>