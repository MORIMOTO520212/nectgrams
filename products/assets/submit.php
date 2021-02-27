<?php
/*
    get products json data
      created:2021.02.27

    products.jsonに情報を記録する
*/
$title = $_POST["title"];
$message = $_POST["message"];
$photo = $_POST["photo"];
$date = getdate()["year"]."/".getdate()["mon"]."/".getdate()["mday"];
$product = array(
    "title" => $title,
    "message" => $message,
    "photo" => $photo,
    "date" => $date
);

$products_data = file_get_contents("../../database/products.json");
$products_data = mb_convert_encoding($products_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$products = json_decode($products_data);

$products[] = $product;

file_put_contents("../../database/products.json", json_encode($products, JSON_PRETTY_PRINT), LOCK_EX);

echo "submit complete.";
?>