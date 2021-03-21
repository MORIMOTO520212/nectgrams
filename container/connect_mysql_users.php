<?php
// connection
$host = "localhost";
$user = "root";
$pass = "";
$DB   = "nectgrams";
$mysqli = new mysqli($host, $user, $pass, $DB);

/* connection check */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// create query
$query = "SELECT * FROM users";
$result = $mysqli->query($query); // run query.
if(!$result) echo "failed to run query.";
?>