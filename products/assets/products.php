<?php
/*
    get products json data
      created:2021.02.26
*/

$products_data = file_get_contents("../../database/products.json");
echo $products_data;
?>