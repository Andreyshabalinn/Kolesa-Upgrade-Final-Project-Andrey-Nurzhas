<?php
include(__DIR__ .'\..\config\config.php');

$dbh  = new PDO($dir) or die("cannot open the database");
//$query =  "SELECT * FROM users;";
//foreach ($dbh->query($query) as $row)
//{
//    echo $row[0];
//}
$dbh = null;