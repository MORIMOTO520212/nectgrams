<?php
// MySQL オブジェクト指向

// 接続する
$host = "localhost";
$user = "root";
$pass = "";
$DB = "test";
$mysqli = new mysqli($host, $user, $pass, $DB);

/* 接続状況をチェック */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// データベースを選択する
$mysqli->select_db("tb1");

// tb1のデータを取得するクエリを実行
$select = " SELECT ";
$colum  = " * ";
$from   = " FROM ";
$table  = " tb1 ";
$query = $select.$colum.$from.$table;

$result = $mysqli->query($query);
if(!$result){
    echo "クエリ実行失敗";
}

// 表示
while($row = $result->fetch_row()){
    var_dump($row);
}

// 終了
$mysqli->close();
?>