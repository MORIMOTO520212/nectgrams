<?php
// connection
$host = "localhost";
$user = "nectgrams";
$pass = "agario520212";
$DB   = "nectgrams";
$mysqli = new mysqli($host, $user, $pass, $DB);

/* connection check */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* database check */
$query = "SELECT * FROM users";
$result = $mysqli->query($query); // run query.
if(!$result) echo "failed to run query.";
?>