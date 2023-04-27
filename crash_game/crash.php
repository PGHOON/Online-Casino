<!DOCTYPE html>
<html>

<head>
    <title>Crash Game</title>
    <link rel="stylesheet" href="crash.css">
    <?php session_start(); ?>
</head>

<body>
    <nav>
        <ul>
            <li><a href="../main/main.php">Home</a></li>
            <li><a href="../dice/dice.php">Dice Game</a></li>
            <li><a href="../crash_game/crash.php">Crash Game</a></li>
            <li><a href="../Slot_Machine/Slotmachine.php">Slot Game</a></li>
            <li><a href="../Log_in/logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="user-info">
        <p>User Information:</p>
        <ul>
            <li>userID:
                <?php echo $_SESSION['userID'] ?>
            </li>
            <li>userName:
                <?php echo $_SESSION['userName'] ?>
            </li>
            <li>Balance: $<span id="balance_ui"></span></li>
        </ul>
    </div>
    <div class="modal" id="modal">
        <div class="modal-header">
            <div class="title">Crashed!!</div>
            <button id="modalClose" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Last game crashed at: <span id="multiplier2"></span></p>
            <p id="resultMoney"></p>
        </div>
    </div>
    <div id="overlay"></div>

    <div>
        <h1>Crash Game</h1>
        <canvas id="graph" width="800" height="400"></canvas>
        <div>
            <label for="bet">Bet amount:</label>
            <input type="number" id="bet" min="0" step="0.01" placeholder="0.00" disabled>
            <button id="place-bet" disabled>Place Bet</button>
            <button id="cash-out" disabled>Cash Out</button>
        </div>
        <div>
            <p>Multiplier: <span id="multiplier">1.00x</span></p>
            <p><span id="current">Balance: $</span></p>
            <p>Next game in <span id="timer">5</span> seconds</p>
        </div>
        <script src="crash.js"></script>
        <script src="modal.js"></script>
</body>

</html>