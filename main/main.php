<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lance Login Successful</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="container">
        <h1>
            <?php foreach ($data as $logged_user) ?>
            <?php echo "user name: " . $logged_user['userName']
            . "<br>user password: " . $logged_user['password']-->; ?>
        </h1>
        <div class="dice">
            <a href="../dice/dice.html"> Dice Game</a>
        </div>
        <div class="crash">
            <a href="../crash_game/crash.html">Crash Game</a>
        </div>
        <div class="slot">
            <a href="../Slot_Machine/Slotmachine.html">Slot Machine</a>
        </div>
        <p>balance : </p>   <!--we need trigger that lines with user table. -->
        <p>etc... : </p>
    </div>
</body>

</html>