<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lance";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the updated coin value from the request
$coin = $_POST["coin"];

// Update the coin column in the database
$user_id = $_SESSION['userID'];
$sql = "UPDATE account SET balance = $coin WHERE userID = $user_id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>