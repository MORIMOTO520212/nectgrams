<?php
require "../container/connect_mysql_users.php";
require "../container/session_check.php";

// vew database
$userData = array();
while($row = $result->fetch_row()) $userData[] = $row;

$session = sessionCheck($userData); // true or false.


$mysqli->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nectgrams - ログイン</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="assets/sha256.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
        <!-- Google Sign In -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="602046748429-g7tk5ermd7p7vcksmt55eisldsnv51mh.apps.googleusercontent.com">
    </head>
    <body>
        <script>var session = <?php echo $session ?>;</script>
        <?php require "../container/header.html"; ?>
        <!--
        <div class="header">
            <div class="logo">
                <a href="../">
                    <p><img src="assets/nectgrams_icon.png">Nectgrams</p>
                </a>
            </div>
            <div class="contents">
                <a href="../products/"><div class="btn product"><p>作品</p></div></a>
                <a href="../activity/"><div class="btn activity"><p>活動</p></div></a>
                <a href="../"><div class="btn about"><p>このサークルについて</p></div></a>
                <a href="../"><div class="btn faq"><p>FAQ</p></div></a>
                <a href="../contact/"><div class="btn contact"><p>コンタクト</p></div></a>
            </div>
            <?php /*
                if($session){
                    echo "<a href=\"javascript:logout();\"><div class=\"btn login\" style=\"border:solid 2px #333\"><p>ログアウト</p></div></a>";
                }else{
                    echo "<a href=\"./\"><div class=\"btn login\"  style=\"border:solid 2px #333\"><p>ログイン</p></div></a>";
                } */
            ?>-->
        </div>
        <div class="main">
            <div class="login-form">
                <input id="id" type="text" placeholder="ID" value="">
                <input id="passwd" type="password" placeholder="パスワード" value="">
                <div class="submit">
                    <a href="javascript:submit();"><p>ログイン</p></a>
                </div>
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </div>
            <div class="msg">
                <p>
                    <?php 
                        if($session){
                            echo "ログインしました。作品の投稿や活動記録を利用できます。";
                        }else{
                            echo "作品の投稿や活動記録をするにはログインしてください。パスワードを忘れた場合は関係者に問い合わせてください。";
                        }
                    ?>
                </p>
            </div>
        </div>
        <div class="footer"></div>
        <script src="assets/base.js"></script>
    </body>
</html>