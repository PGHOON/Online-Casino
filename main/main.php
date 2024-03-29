<!DOCTYPE html>

<head>
    <title>Lance main page</title>
    <link rel="stylesheet" type="text/css" href="main1.css">
    <?php if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if ($_SESSION['userID'] == 0) {
        header('Location: ../admin/admin.php');
    }
    ?>
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
            <li>Balance: $
                <?php echo $_SESSION['balance'] ?>
            </li>
        </ul>
    </div>
    <div id="slider">
        <figure>
            <img src="img/main.jpg">
            <img src="img/img2.jpeg">
            <img src="img/img4_c.jpg">
            <img src="img/img1.png">
            <img src="img/main.jpg">
        </figure>
    </div>
</body>

</html>