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

$userData = array();

// データベース表示
while($row = $result->fetch_row()){
    $userData[] = $row;
}

// 終了
$mysqli->close();

foreach($userData as $user){ // $user[0]-userName,  $user[1]-password,  $user[2]-userId
    echo "ユーザー：".$user[0]."<br>パスワード：".$user[1]."<br>ユーザーID：".$user[2]."<br><br>";
}
?>