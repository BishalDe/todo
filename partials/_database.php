<?php
/*$servername = 'db4free.net';
$usernames = 'bishalde';
$password = 'bishal@5741';
$database = 'clustix';*/

$servername = 'localhost';
$usernames = 'bishal';
$password = 'bishal';
$database = 'todoapp';


$conn = mysqli_connect($servername, $usernames, $password, $database);
if (!$conn) {
  die("Error connecting to MYSQL" . mysqli_connect_error());
  exit(1);
}
?>