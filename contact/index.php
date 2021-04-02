<?php
require "../container/connect_mysql_users.php";
require "../container/login_session_check.php";

$session = sessionCheck($mysqli); // return true or false.
?>
<!DOCTYPE html>
<html>
    <head id="head">
        <title>Nectgrams - コンタクト</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <?php require "../container/metadata.html" ?>
    </head>
    <body>
        <script>var session = <?php echo $session ?>;</script>
        <?php require "../container/header.html" ?>
        <div class="g-signin2" data-onsuccess="onSignIn" style="display:none;"></div>
        <div class="main">
            <div class="msg">
                <p>意見、改善点、トラブル報告…</p>
                <p>サークル内のことはなんでも気軽にどうぞ！</p>
                <p>サークルの加入についてはサークル管理者に連絡してください。</p>
            </div>
            <div class="contact-main">
                <div class="control"><p>サークル管理</p></div>
                <div class="manager">
                    <div>
                        <a class="discord" href="#" onclick="window.open('../container/invite_discord/?name=囮猫&user=囮猫#4996','subwin','width=300,height=300');return false;"><img src="assets/Discord-Logo-Color.svg"></a>
                        <a class="twitter" href="https://twitter.com/I_am_bakeneko" target="_blank" rel="noopener"><img src="assets/Twitter-social-icon.svg"></a>
                        <p>囮猫</p>
                    </div>
                    <div>
                        <a class="twitter" href="https://twitter.com/nectgrams" target="_blank" rel="noopener"><img src="assets/Twitter-social-icon.svg"></a>
                        <p>Nectgrams 公式</p>
                    </div>
                </div>
                <div class="control"><p>ホームページ管理</p></div>
                <div class="manager">
                    <div>
                        <a class="discord" href="#" onclick="window.open('../container/invite_discord/?name=morimotoyuma.&user=morimotoyuma.#0422','subwin','width=300,height=300');return false;"><img src="assets/Discord-Logo-Color.svg"></a>
                        <a class="twitter" href="https://twitter.com/Medaka_Bridle" target="_blank" rel="noopener"><img src="assets/Twitter-social-icon.svg"></a>
                        <p>森本 悠真</p>
                    </div>
                    <div>
                        <a class="discord" href="#" onclick="window.open('../container/invite_discord/?name=さほ&user=さほ#8285','subwin','width=300,height=300');return false;"><img src="assets/Discord-Logo-Color.svg"></a>
                        <a class="twitter" href="#" target="_blank" rel="noopener"><img src="assets/Twitter-social-icon.svg"></a>
                        <p>近藤 紗帆</p>
                    </div>
                    <div>
                        <a class="discord" href="#" onclick="window.open('../container/invite_discord/?name=でもそれってあなたの感想ですよね？&user=でもそれってあなたの感想ですよね？#5056','subwin','width=300,height=300');return false;"><img src="assets/Discord-Logo-Color.svg"></a>
                        <a class="twitter" href="#" target="_blank" rel="noopener"><img src="assets/Twitter-social-icon.svg"></a>
                        <p>栗田 悠矢</p>
                    </div>
                </div>
            </div>
        </div>
        <?php require "../container/footer.html" ?>
    </body>
</html>