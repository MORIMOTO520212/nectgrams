<?php
function get_user_data($mysqli, $mid) {
    $query = "SELECT * FROM users WHERE mid='$mid'";
    $userData = $mysqli->query($query)->fetch_row();
    return $userData;
}
?>