<!DOCTYPE html>
<html>

<head>
    <title>Slot Game</title>
    <link rel="stylesheet" href="SlotMachine.css">
    <?php if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    } ?>
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
            <li>userID:
                <?php echo $_SESSION['userID'] ?>
            </li>
            <li>userName:
                <?php echo $_SESSION['userName'] ?>
            </li>
            <li>Balance: $<span id="balance"></span></li>
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
    </div>
    <p><span id="current">COIN :</span></p>
    <script src="spin.js"></script>
    <img src="reward_t.png" alt="Logo" class="center">
</body>

</html>