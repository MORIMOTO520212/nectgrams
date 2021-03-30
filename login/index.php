<?php
require "../container/connect_mysql_users.php";
require "../container/login_session_check.php";

$session = sessionCheck($mysqli);

$mysqli->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nectgrams - ログイン</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <script src="assets/sha256.js"></script>
        <?php require "../container/metadata.html" ?>
        <?php require "../container/open_graph_protocol.html" ?>
    </head>
    <body>
        <script>var session = <?php echo $session ?>;</script>
        <?php require "../container/header.html"; ?>
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