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
            <div class="products">

                <div class="product-box">
                    <div class="box-main">
                        <div class="image"><img src="assets/add.png"></div>
                        <div class="text">
                            <p class="header">追加する</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="product-box">
                    <div class="box-main">
                        <div class="image"><img src="assets/dummy.png"></div>
                        <div class="text">
                            <p class="header">活動ページです</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="product-box">
                    <div class="box-main">
                        <div class="image"><img src="https://pbs.twimg.com/media/DjrTeBGU4AA7q01.jpg"></div>
                        <div class="text">
                            <p class="header">Header Title</p>
                            <p>Example Text</p>
                        </div>
                    </div>
                </div>
                <div class="product-box">
                    <div class="box-main">
                        <div class="image"><img src="https://stat.ameba.jp/user_images/20180330/07/orizin4koma/62/99/j/o0600033814159924572.jpg"></div>
                        <div class="text">
                            <p class="header">Header Title</p>
                            <p>Example Text</p>
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