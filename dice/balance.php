<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "lance");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['userID'];
$sql = "SELECT balance FROM account WHERE userID = $user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$coin_balance = $row['balance'];

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode(array('coin' => $coin_balance));
?>