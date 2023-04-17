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
	<?php
		session_start();
    	echo "The current userID(session) is : " . $_SESSION['userID'];
    ?>
  </body>
	<script src="spin.js"></script>
</body>
</html>