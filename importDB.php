<?php

$mysql_host = "app-0e7ce01b-1bea-470a-b0c9-b827676e00d8-do-user-8450168-0.b.db.ondigitalocean.com:25060";
$mysql_database = "portal";
$mysql_user = "portal";
$mysql_password = "ys21smzouaqhyqx2";


# MySQL with PDO_MYSQL  
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
$query = file_get_contents("portal.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()){
     echo "Success";
}else{ 
     echo "Fail"
}


?>