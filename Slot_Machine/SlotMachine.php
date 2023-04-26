<?php
session_start();

// Database Connection
$host = 'localhost';
$dbname = 'lance';
$username = 'root';
$password = '';

// Test Connection
try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

// Query for user account
if (isset($_SESSION['userID'])) {
	$query = "SELECT * FROM account WHERE account.userID = :userID";

	$stmt = $conn->prepare($query);
	$stmt->bindParam(':userID', $_SESSION['userID']);
	$stmt->execute();

	// Check for errors
	if ($stmt) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	} else {
		echo "Error retrieving user account.";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Slot Machine Protopyte</title>
	<link rel="stylesheet" href="SlotMachine.css">
</head>

<body>
	<nav>
		<ul>
			<li><a href="../main/main.php">Home</a></li>
			<li><a href="../dice/dice.php"> Dice Game</a></li>
			<li><a href="../crash_game/crash.php">Crash Game</a></li>
			<li><a href="../Slot_Machine/SlotMachine.php">Slot Game</a></li>
			<li><a href="../Log_in/logout.php">Logout</a></li>
		</ul>
	</nav>
	<div class="user-info">
		<p>User Information:</p>
		<ul>
			<li>userID: <?php echo $_SESSION['userID'] ?></li>
			<li>userName: <?php echo $_SESSION['userName'] ?></li>
			<li>Balance: $<?php echo $_SESSION['balance'] ?></li>
		</ul>
	</div>
	<div id="container">
		<div class="slot">
			<img id="slot1" src="symbols/lemon.png" alt="lemon image">
		</div>
		<div class="slot">
			<img id="slot2" src="symbols/cherry.png" alt="cherry image">
		</div>
		<div class="slot">
			<img id="slot3" src="symbols/apple.png" alt="apple image">
		</div>
		<button onclick="spin()">Spin</button>
		<p><span id="current">COIN :</span></p>
	</div>
	<script src="spin.js"></script>
</body>
</html>