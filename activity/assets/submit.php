<?php
/*
    get activity json data
      created:2021.03.16

    activity.jsonに情報を記録する
*/
$date = $_POST["date"];
$group = $_POST["group"];
$contributor = $_POST["contributor"];
$target_text = $_POST["target"];
$do_text = $_POST["do"];
$share_text = $_POST["share"];

$activity = array(
    "date" => $date,
    "group" => $group,
    "contributor" => $contributor,
    "target_text" => $target_text,
    "do_text" => $do_text,
    "share_text" => $share_text
);

$activities_data = file_get_contents("../../database/activities.json");
$activities_data = mb_convert_encoding($activities_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$activities = json_decode($activities_data);

$activities[] = $activity; // add data.

file_put_contents("../../database/activities.json", json_encode($activities, JSON_PRETTY_PRINT), LOCK_EX);

echo "submit complete.";
?>