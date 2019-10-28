<?php

$server = "localhost";
$dbname = ($_SERVER['HTTP_HOST'] === "www.localhost.com.br") ? "dbphp7" : "id5155422_dbphp7";
$user   = ($_SERVER['HTTP_HOST'] === "www.localhost.com.br") ? "production" : "id5155422_production";
$pass   = "123mudar";

$control_head = 0;

$firstline = "";

$getid = 0;

$conn = new PDO("mysql:dbname=$dbname;host=$server", $user, $pass);

?>
