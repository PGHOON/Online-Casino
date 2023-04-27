<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dice.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <title>Dice</title>
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
            <li>Balance: $
                <span id="balance"></span>
            </li>
        </ul>
    </div>
    <div class="game">
        <div class="container">
            <div id="dice1" class="dice dice-one show-1">
                <div id="dice-one-side-one" class="side one">
                    <div class="dot one-1"></div>
                </div>
                <div id="dice-one-side-two" class="side two">
                    <div class="dot two-1"></div>
                    <div class="dot two-2"></div>
                </div>
                <div id="dice-one-side-three" class="side three">
                    <div class="dot three-1"></div>
                    <div class="dot three-2"></div>
                    <div class="dot three-3"></div>
                </div>
                <div id="dice-one-side-four" class="side four">
                    <div class="dot four-1"></div>
                    <div class="dot four-2"></div>
                    <div class="dot four-3"></div>
                    <div class="dot four-4"></div>
                </div>
                <div id="dice-one-side-five" class="side five">
                    <div class="dot five-1"></div>
                    <div class="dot five-2"></div>
                    <div class="dot five-3"></div>
                    <div class="dot five-4"></div>
                    <div class="dot five-5"></div>
                </div>
                <div id="dice-one-side-six" class="side six">
                    <div class="dot six-1"></div>
                    <div class="dot six-2"></div>
                    <div class="dot six-3"></div>
                    <div class="dot six-4"></div>
                    <div class="dot six-5"></div>
                    <div class="dot six-6"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="dice2" class="dice dice-two show-1">
                <div id="dice-two-side-one" class="side one">
                    <div class="dot one-1"></div>
                </div>
                <div id="dice-two-side-two" class="side two">
                    <div class="dot two-1"></div>
                    <div class="dot two-2"></div>
                </div>
                <div id="dice-two-side-three" class="side three">
                    <div class="dot three-1"></div>
                    <div class="dot three-2"></div>
                    <div class="dot three-3"></div>
                </div>
                <div id="dice-two-side-four" class="side four">
                    <div class="dot four-1"></div>
                    <div class="dot four-2"></div>
                    <div class="dot four-3"></div>
                    <div class="dot four-4"></div>
                </div>
                <div id="dice-two-side-five" class="side five">
                    <div class="dot five-1"></div>
                    <div class="dot five-2"></div>
                    <div class="dot five-3"></div>
                    <div class="dot five-4"></div>
                    <div class="dot five-5"></div>
                </div>
                <div id="dice-two-side-six" class="side six">
                    <div class="dot six-1"></div>
                    <div class="dot six-2"></div>
                    <div class="dot six-3"></div>
                    <div class="dot six-4"></div>
                    <div class="dot six-5"></div>
                    <div class="dot six-6"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="betting-corner">
        <form>
            <div class="bets">
                <div class="rc-toolbar">
                    <input type="checkbox" id="odd" name="oe" value="odd">
                    <label for="odd">ODD<br>1.93</label>
                    <input type="checkbox" id="even" name="oe" value="even">
                    <label for="even">EVEN<br> 1.93</label><br>
                </div>

                <div class="rc-toolbar">
                    <input type="checkbox" id="red" name="rb" value="red">
                    <label for="red">RED<br>1.93</label>
                    <input type="checkbox" id="blue" name="rb" value="blue">
                    <label for="blue">BLUE<br>1.93</label>
                    <input type="checkbox" id="tie" name="rb" value="tie">
                    <label for="tie">TIE<br>4.5</label><br>
                </div>
                <div class="rc-toolbar">
                    <input type="checkbox" id="under" name="uo" value="under">
                    <label for="under">UNDER<br>1.93</label>
                    <input type="checkbox" id="over" name="uo" value="over">
                    <label for="over">OVER<br>1.93</label>
                    <input type="checkbox" id="seven" name="uo" value="seven">
                    <label for="seven">SEVEN<br>4.5</label><br>
                </div>
            </div>
            <br><label for="curMoney">Money you have: $</label>
            <span id="curMoney"></span><br><br>
            <label for="betMoney">Money you want to bet: $</label>
            <input type="number" id="betMoney" min="5">
        </form>

        <div id="roll" class="roll-button">
            <button class="dice-button">Roll dice!</button>
        </div>
    </div>
    <script src="dice2.js"></script>
</body>

</html>