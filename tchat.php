<?php
session_start();
$_SESSION['user']['username'];

$bdd = new PDO("mysql:host=localhost;dbname=chatbox; charset=utf8", "root", "root");

require_once "./php/home.php.php"

?>