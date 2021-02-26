<?php
// MySQL オブジェクト指向
//
//    [挿入]
//    INSERT INTO テーブル名 VALUES("", ""・・・);
//    [指定して抽出]
//    SELECT * FROM テーブル名 WHERE カラム名="文字列(完全一致)";
//
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

$check_id = $_POST["id"];
$check_pass = $_POST["password"];
foreach($userData as $user){ // $user[0]-userName,  $user[1]-password(SHA256),  $user[2]-userId
    $sql_userName = $user[0];
    $sql_pass     = $user[1];
    $sql_userId   = $user[2];
    if($check_id == $sql_userName && hash("sha256", $check_pass) == $sql_pass){
        echo $sql_userId;
    }
}
?>