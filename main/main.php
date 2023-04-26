<!DOCTYPE html>
<head>
    <title>Lance main page</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../dice/dice.php"> Dice Game</a></li>
            <li><a href="../crash_game/crash.html">Crash Game</a></li>
            <li><a href="../Slot_Machine/Slotmachine.php">Slot Machine</a></li>
            <li><a href="../Log_in/logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="box">
        <h1>
            <?php foreach ($data as $logged_user) ?>
            <?php
            $_SESSION['userID'] = $logged_user['userID'];
            if ($_SESSION['userID'] == 0) {
                header('Location: ../admin/admin.php');
            }
            ?>
            <?php echo "user name: " . $logged_user['userName']
            . "<br>user password: " . $logged_user['password']
            . "<br>user balance: " . $logged_user['balance']
            . "<br>user id: " . $logged_user['userID']
            . "<br>user id(session): " . $_SESSION['userID']?>
        </h1>
    </div>
</body>
</html>