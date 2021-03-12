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
$products_data = file_get_contents("../database/products.json");
$products_data = mb_convert_encoding($products_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$products = json_decode($products_data, true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nectgrams - 作品</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
        <script>

        </script>
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
                <a href="../activity/"><div class="btn activity"><p>活動</p></div></a>
                <a href="../"><div class="btn about"><p>このサークルについて</p></div></a>
                <a href="../"><div class="btn faq"><p>FAQ</p></div></a>
                <a href="../contact/"><div class="btn contact"><p>コンタクト</p></div></a>
            </div>
            <?php
                if($session){
                    echo "<a href=\"javascript:logout();\"><div class=\"btn login\"><p>ログアウト</p></div></a>";
                }else{
                    echo "<a href=\"../login/\"><div class=\"btn login\"><p>ログイン</p></div></a>";
                }
            ?>
        </div>
        <div class="main">
            <div id="products">
                <?php
                    if($session){ // echo "の後に改行しないとcssのbeforeとafterが反映されない
                        echo "
                        <div class=\"product-box\">
                            <div class=\"box-main\">
                                <div id=\"drag-area\" class=\"image hover\">
                                    <img id=\"setimg\" src=\"assets/add.png\">
                                    <input type=\"file\" multiple=\"multiple\" style=\"display:none;\" name=\"files\"/>
                                    <button id=\"btn\">ファイルを選択</button>
                                    <div class=\"create-btn\"><a href=\"javascript:submit();\">投稿</a></div>
                                </div>
                                <div class=\"text\">
                                    <input id=\"header\" type=\"text\" placeholder=\"ここへタイトル\">
                                    <textarea id=\"message\" placeholder=\"ここへメッセージ\"></textarea>
                                </div>
                            </div>
                        </div>";
                    }
                    foreach($products as $product){
                        echo "
                        <div class=\"product-box\">
                            <div class=\"box-main\">
                                <div class=\"image\">
                                    <img src=\"../".$product["photo"]."\">
                                    <div class=\"date\"><p>".$product["date"]."</p></div>
                                </div>
                                <div class=\"text\">
                                    <p class=\"header\">".$product["title"]."</p>
                                    <p>".str_replace("\n", "<br>", $product["message"])."</p>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
        <div class="footer"></div>
        <script src="assets/base.js"></script>
    </body>
</html>