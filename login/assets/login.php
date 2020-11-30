<?php
$mysqli = new mysqli('localhost', 'root', '');
$db_selected = mysqli_select_db('test', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysqli_error());
}
?>