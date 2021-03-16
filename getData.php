<?php

function product() {
    return file_get_contents("database/products.json");
}
function activity() {
    return file_get_contents("database/activities.json");
}

if ( isset($_POST["dataType"]) ) {

    switch ($_POST["dataType"]) {
        case "product":
            $data = product();
            break;
        case "activity":
            $data = activity();
    }
    echo $data;
}
?>