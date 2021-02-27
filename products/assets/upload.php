<?php

$tempfile = $_FILES["files"]["tmp_name"];
$filename = "../../database/images/".$_FILES["files"]["tmp_name"];
if (is_uploaded_file($tempfile)) {
    if (move_uploaded_file($tempfile , $filename)) {
	    echo "ファイルのアップロードが完了しました。\n";
    } else {
        echo "ファイルがアップロードできませんでした。\nページを更新してください。";
    }
} else {
    echo "ファイルが選択されていません。";
} 
exit;
?>