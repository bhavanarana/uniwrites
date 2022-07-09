<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'uniwrites';
$conn = mysqli_connect($host, $username, $password, $db);
if (!$conn) {
  die('failed' . mysqli_connect_error());
}
if (isset($_REQUEST['logout'])) {
  session_destroy();
  header("Location: index.php");
  exit();
}
error_reporting(E_ERROR | E_PARSE);
