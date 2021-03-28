<?php
/*
    get activity json data
      created:2021.03.16
*/
$kind = $_POST["kind"];
$mid = $_POST["mid"];
$date = $_POST["date"];
$group = $_POST["group"];
$contributor = $_POST["contributor"];
$target = $_POST["target"];
$do = $_POST["do"];
$complete = $_POST["complete"];
$share = $_POST["share"];

$activity = array(
    "kind" => $kind,
    "mid" => $mid,
    "date" => $date,
    "group" => $group,
    "contributor" => $contributor,
    "target" => $target,
    "do" => $do,
    "complete" => (int)$complete,
    "share" => $share
);

$activities_data = file_get_contents("../../database/activities.json");
$activities_data = mb_convert_encoding($activities_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$activities = json_decode($activities_data);

$activities[] = $activity; // add data.

file_put_contents("../../database/activities.json", json_encode($activities, JSON_PRETTY_PRINT), LOCK_EX);

echo "submit complete.";
?>