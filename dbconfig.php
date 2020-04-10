<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "quiz-test";

// Create connection
$con = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  // echo "Connected successfully";
}
