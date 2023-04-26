<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $coin = json_decode(file_get_contents('php://input'), true)['coin'];
  $_SESSION['balance'] = $coin;

  $user_id = $_SESSION['userID'];
  $sql = "UPDATE account SET balance = $coin WHERE userID = $user_id";

  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }
} else {
  echo 'Only PUT requests are allowed';
  exit();
}
$conn->close();
?>