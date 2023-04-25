<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lance main page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="container">
        <h1>
            <?php foreach ($data as $logged_user) ?>
            <?php
            $_SESSION['userID'] = $logged_user['userID'];
            ?>
            <?php echo "user name: " . $logged_user['userName']
            . "<br>user password: " . $logged_user['password']
            . "<br>user balance: " . $logged_user['balance']
            . "<br>user id: " . $logged_user['userID']
            . "<br>user id(session): " . $_SESSION['userID']?>
        </h1>
        <div class="dice">
            <a href="../dice/dice.php"> Dice Game</a>
        </div>
        <div class="crash">
            <a href="../crash_game/crash.html">Crash Game</a>
        </div>
        <div class="slot">
            <a href="../Slot_Machine/Slotmachine.php">Slot Machine</a>
        </div>
    </div>
</body>
</html>