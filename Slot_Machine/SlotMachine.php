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
	} catch(PDOException $e) {
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
			if ($row) {
				$balance = $row['balance'];
				echo '<p style="color: ' . 'white' . '">'
				. "The current userID(session) is : " . $_SESSION['userID']
				. "<br>user balance: " . $balance . '</p>';
			}
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
        <p><span id="current">COIN : 20</span></p>
	</div>
	<script src="spin.js"></script>
</body>
</html>