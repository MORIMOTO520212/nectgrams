<?php
require "../container/connect_mysql_users.php";
require "../container/login_session_check.php";

$userData = array(); // ユーザーデータ

// データベース表示
while($row = $result->fetch_row()) $userData[] = $row;

$session = sessionCheck($userData); // return true or false.

// get products json data
$activities_data = file_get_contents("../database/activities.json");
$activities_data = mb_convert_encoding($activities_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$activities = json_decode($activities_data, true);

// 終了
$mysqli->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nectgrams - 活動</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
        <?php require "../container/open_graph_protocol.html" ?>
    </head>
    <body>
        <script>var session = <?php echo $session ?>;</script>
        <?php require "../container/header.html" ?>
        <div class="main">
            <div class="control">
                <div class="kc">
                    <div id="person_kind" class="pgc-btn left-btn" style><a id="pk_a" href="#" onclick="activities_view('person',0);return false;"></a><p id="pk_p" style>個人記録</p></div>
                    <div id="group_kind" class="pgc-btn right-btn" style><a id="gk_a" href="#" onclick="activities_view('group',0);return false;"></a><p id="gk_p" style>班記録</p></div>
                </div>
                <div class="kc">
                    <div id="colum_normal" class="pgc-btn left-btn" style><a href="#" onclick="activities_view(0,'normal');return false;"><p id="cn_p" style>新しい順</p></a></div>
                    <div id="colum_reverse" class="pgc-btn right-btn" style><a href="#" onclick="activities_view(0,'reverse');return false;"></a><p id="cr_p" style>古い順</p></div>
                </div>
            </div>
            <div id="activities" class="activities"></div>
        </div>
        <div class="footer">
            <div class="f-main">
                <div class="f-title"><p>Nectgrams</p></div>
                <div class="f-msg"><p>ここへフッターのメッセージを書きます。</p></div>
                <div class="f-link">
                    <a href="#">作品</a>
                    <a href="#">活動</a>
                    <a href="#">このサークルについて</a>
                    <a href="#">FAQ</a>
                    <a href="#">コンタクト</a>
                </div>
            </div>
        </div>
        <script src="assets/base.js"></script>
    </body>
</html>