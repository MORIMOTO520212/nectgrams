<?php
require "../container/connect_mysql_users.php";
require "../container/login_session_check.php";
require "../container/get_user_data.php";

$userData = array(); // ユーザーデータ

$session = sessionCheck($mysqli); // return true or false.

if($session){
    $userData = get_user_data($mysqli, $_COOKIE["session"]);
    $userName = base64_decode($userData[4]);
    $userGroup = base64_decode($userData[5]);
}else{
    $userName = "";
    $userGroup = "";
}

// get products json data
$activities_data = file_get_contents("../database/activities.json");
$activities_data = mb_convert_encoding($activities_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$activities = json_decode($activities_data, true);

// 終了
$mysqli->close();
?>
<!DOCTYPE html>
<html>
    <head id="head">
        <title>Nectgrams - 活動</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <?php require "../container/metadata.html" ?>
        <?php require "../container/open_graph_protocol.html" ?>
    </head>
    <body>
        <script>
            var session = <?php echo $session ?>;
            var userName = "<?php echo $userName ?>";
            var userGroup = "<?php echo $userGroup ?>";
        </script>
        <?php require "../container/header.html" ?>
        <div class="g-signin2" data-onsuccess="onSignIn" style="display:none;"></div>
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
            <div id="activities" class="activities">
                <div class="activity-box">
                    <div class="box-main">
                        <div class="contributor inp">
                            <input id="date" type="date" value="2021-03-16">
                            <input id="group" type="text" placeholder="所属班" value="">
                            <input id="contributor" type="text" placeholder="入力者" value="">
                            <div class="create-btn"><a id="submit" href="javascript:submit(\'\');">投稿</a></div>
                        </div>
                        <div class="main">
                            <div class="control control-kind">
                                <div class="kc">
                                    <div id="ak_new" class="pgc-btn left-btn" style><a id="ak_new_a" href="#" onclick="activity_control('new');return false;"></a><p id="ak_new_p" style>新規</p></div>
                                    <div id="ak_group" class="pgc-btn right-btn" style><a id="ak_group_a" href="#" onclick="activity_control('activity');return false;"></a><p id="ak_group_p" style>活動</p></div>
                                </div> 
                            </div>
                            <div id="ak_contents">
                                <div class="record">
                                    <li class="title">できたこと　　達成度：<input id="complete" type="text" placeholder="1~10"></li>
                                    <div class="contents">
                                        <textarea id="target" placeholder="活動状況を記入してください。"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require "../container/footer.html" ?>
        <script src="assets/base.js"></script>
    </body>
</html>