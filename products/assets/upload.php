<?php

$tempfile = $_FILES["files"]["tmp_name"][0];
$filename = $_FILES["files"]["name"][0];
$type = preg_split("/[.]/", $filename)[1];
$name = rand(100000, 999999);

$filename = "../../database/images/".$name.".".$type;


if (is_uploaded_file($tempfile)) {
    if (move_uploaded_file($tempfile , $filename)) {
	    echo $name.".".$type;
    } else {
        echo "ファイルがアップロードできませんでした。\nページを更新してください。";
    }
} else {
    echo "ファイルが選択されていません。";
} 
exit;
?>