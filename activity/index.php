<?php
// 接続する
$host = "localhost";
$user = "root";
$pass = "";
$DB   = "nectgrams";
$mysqli = new mysqli($host, $user, $pass, $DB);

/* 接続状況をチェック */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// クエリ作成
$select = " SELECT ";
$colum  = " * ";
$from   = " FROM ";
$table  = " base ";
$query = $select.$colum.$from.$table;

$result = $mysqli->query($query); // クエリ実行
if(!$result){
    echo "クエリ実行失敗";
}

$userData = array(); // ユーザーデータ

// データベース表示
while($row = $result->fetch_row()){
    $userData[] = $row;
}

// 終了
$mysqli->close();


// ユーザーセッション
$session = false;
$userSession = ""; // ログインしてない場合  
foreach($_COOKIE as $key => $value){ // cookie確認と取得
    if("session" == $key){
          $userSession = $_COOKIE["session"];
    }
}
foreach($userData as $user){ // $user[0]-userName,  $user[1]-password(SHA256),  $user[2]-userId
    $sql_userId = $user[2];
    if($userSession == $sql_userId){
        $session = true;
    }
}
// get products json data
$activities_data = file_get_contents("../database/activity.json");
$activities_data = mb_convert_encoding($activities_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$activities = json_decode($activities_data, true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nectgrams - 活動</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <a href="../">
                    <p><img src="assets/nectgrams_icon.png">Nectgrams</p>
                </a>
            </div>
            <div class="contents">
                <a href="../products/"><div class="btn product"><p>作品</p></div></a>
                <a href="../activity/"><div class="btn activity" style="border:solid 2px #333"><p>活動</p></div></a>
                <a href="../"><div class="btn about"><p>このサークルについて</p></div></a>
                <a href="../"><div class="btn faq"><p>FAQ</p></div></a>
                <a href="../contact/"><div class="btn contact"><p>コンタクト</p></div></a>
            </div>
            <a href="../login/"><div class="btn login"><p>ログイン</p></div></a>
        </div>
        <div class="main">
            <div class="activities">

                <div class="activity-box">
                    <div class="box-main">
                        <div class="contributor inp">
                            <input id="date" type="date" value="2021-03-16">
                            <input id="group" type="text" placeholder="所属班">
                            <input id="contributor" type="text" placeholder="入力者">
                            <div class="create-btn"><a href="javascript:submit();">投稿</a></div>
                        </div>
                        <div class="main">
                            <div class="record">
                                <li class="title">目標</li>
                                <div class="contents">
                                    <textarea id="target" placeholder="今回の活動目標を記入してください。"></textarea>
                                </div>
                            </div>
                            <div class="record">
                                <li class="title">できたこと</li>
                                <div class="contents">
                                    <textarea id="do" placeholder="活動した内容について記入してください。"></textarea>
                                </div>
                            </div>
                            <div class="record">
                                <li class="title">共有したいこと</li>
                                <div class="contents">
                                <textarea id="share" placeholder="全体や班の内で共有したいことや疑問点があればそれについて記入してください。"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="activity-box">
                    <div class="box-main">
                        <div class="contributor">
                            <p>2021/3/15 WEB班 森本悠真</p>
                        </div>
                        <div class="main">
                            <div class="record">
                                <li id="target" class="title">目標</li>
                                <div class="contents"><p>ホームページのCSSでのレイアウト設計を完成させる。</p></div>
                            </div>
                            <div class="record">
                                <li id="do" class="title">できたこと</li>
                                <div class="contents"><p>ホームページのヘッダーとフッターのレイアウト設計を完成させた。レスポンシブ対応はこれから。</p></div>
                            </div>
                            <div class="record">
                                <li id="share" class="title">共有したいこと</li>
                                <div class="contents"><p>Let's Encryptという無料のSSLがあるらしい。</p></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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