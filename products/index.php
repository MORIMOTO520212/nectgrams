<?php
require "../container/connect_mysql_users.php";
require "../container/login_session_check.php";

// データベース表示
$userData = array(); // ユーザーデータ
while($row = $result->fetch_row()) $userData[] = $row;

$session = sessionCheck($userData); // return true or false.

// get products json data
$products_data = file_get_contents("../database/products.json");
$products_data = mb_convert_encoding($products_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$products = json_decode($products_data, true);

// 終了
$mysqli->close();
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
        <script src="../container/markdown.js"></script>
        <link rel="stylesheet" type="text/css" href="../container/markdown.css">
        <?php require "../container/open_graph_protocol.html" ?>
    </head>
    <body>
    <script>var session = <?php echo $session ?>;</script>
        <?php require "../container/header.html" ?>
        <div id="main" style>
            <div id="products">
                <?php
                    if($session){ // echo "の後に改行しないとcssのbeforeとafterが反映されない
                        echo '
                        <div class="product-box">
                            <div class="box-main">
                                <div id="drag-area" class="image hover">
                                    <img id="setimg" src="assets/add.png">
                                    <input type="file" multiple="multiple" style="display:none;" name="files"/>
                                    <button id="btn">ファイルを選択</button>
                                    <div class="create-btn document"><a href="javascript:documentWrite();">内容</a></div>
                                    <div class="create-btn submit"><a href="javascript:submit();">投稿</a></div>
                                </div>
                                <div class="text">
                                    <input id="header" type="text" placeholder="ここへタイトル">
                                    <textarea id="message" placeholder="ここへメッセージ"></textarea>
                                </div>
                            </div>
                        </div>';
                    }
                    foreach($products as $product){
                        echo '
                        <div class="product-box">
                            <div class="box-main">
                                <div class="image">
                                    <img src="../'.$product["photo"].'">
                                    <div class="date"><p>'.$product["date"].'</p></div>
                                </div>
                                <div class="text">
                                    <p class="header">'.$product["title"].'</p>
                                    <p>'.str_replace("\n", "<br>", $product["message"]).'</p>
                                </div>
                            </div>
                        </div>';
                    }
                ?>
            </div>
        </div>
        <div id="document" style="display:none;">
            <div class="top">
                <div class="product-title"><p id="document_title">作品のタイトル</p></div>
                <div id="markdown-close"><a href="javascript:markdownCloseWindow();"><img src="../assets/close_icon.svg"></a></div>
            </div>
            <textarea id="input_markdown"></textarea>
            <div id="preview"></div>
            <div class="document-submit-btn"><a href="javascript:document_submit();">保存する</a></div>
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