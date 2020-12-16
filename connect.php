<?php

$servername = "app-0e7ce01b-1bea-470a-b0c9-b827676e00d8-do-user-8450168-0.b.db.ondigitalocean.com:25060";
$username = "portal";
$pwd = "ys21smzouaqhyqx2";
$dbname = "portal";

// Create connection
$conn = new mysqli($servername, $username, $pwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>