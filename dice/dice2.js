var elDiceOne = document.getElementById('dice1');
var elDiceTwo = document.getElementById('dice2');
var elComeOut = document.getElementById('roll');
var rollButton = document.querySelector('.dice-button');

var showClasses = ['show-1', 'show-2', 'show-3', 'show-4', 'show-5', 'show-6'];

var coin = 0;
var current = document.getElementById("curMoney");
var balance = document.getElementById("balance");

console.log("asdf");
var xhr = new XMLHttpRequest();
xhr.open('GET', 'balance.php');
xhr.onload = function () {
    console.log("xml working");
    if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        coin = response.coin;
        current.innerHTML = coin;
        balance.innerHTML = coin;
    } else {
        console.log('Request failed.  Returned status of ' + xhr.status);
    }
};
xhr.send();

function updateCoin(coin) {
    fetch('../Slot_machine/updatecoin.php', {
        method: 'PUT',
        body: JSON.stringify({ coin: coin }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error(error));
}



//disables button when dice is rolling
function enableButton(button) {
    button.disabled = false;
}

function revert1(normal) {
    elDiceOne.classList.remove(...showClasses);
    elDiceOne.classList.add('show-' + normal);
    //console.log("checking for timeout after: " + elDiceOne.classList[2].slice(5));
}

function revert2(normal) {
    elDiceTwo.classList.remove(...showClasses);
    elDiceTwo.classList.add('show-' + normal);
    //console.log("checking for timeout after: " + elDiceTwo.classList[2].slice(5));
}

function sameside1(prev) {
    var temp_show = 7 - prev;
    elDiceOne.classList.remove(...showClasses);
    elDiceOne.classList.add('show-' + temp_show);
}

function sameside2(prev) {
    var temp_show = 7 - prev;
    elDiceTwo.classList.remove(...showClasses);
    elDiceTwo.classList.add('show-' + temp_show);
}

function rollDice() {
    rollButton.disabled = true;
    setTimeout(enableButton, 1500, rollButton);
    var pre_dice1 = elDiceOne.classList[2].slice(5);
    var pre_dice2 = elDiceTwo.classList[2].slice(5);
    // console.log("previous dot 1: " + pre_dice1);
    // console.log("previous dot 2: " + pre_dice2);
    var diceOne = Math.floor((Math.random() * 6) + 1);
    var diceTwo = Math.floor((Math.random() * 6) + 1);

    //console.log(diceOne + ' ' + diceTwo);

    if (pre_dice1 == diceOne) {
        //console.log("same side 1");
        sameside1(pre_dice1);
        //console.log("checking for timeout before: " + elDiceOne.classList[2].slice(5));
        setTimeout(revert1, 300, diceOne);
    }
    else {
        elDiceOne.classList.remove(...showClasses);
        elDiceOne.classList.add('show-' + diceOne);
    }

    if (pre_dice2 == diceTwo) {
        //console.log("same side 2");
        sameside2(pre_dice2);
        //console.log("checking for timeout before: " + elDiceTwo.classList[2].slice(5));
        setTimeout(revert2, 300, diceTwo);
    }
    else {
        elDiceTwo.classList.remove(...showClasses);
        elDiceTwo.classList.add('show-' + diceTwo);
    }
    //console.log("after dot1 : " + elDiceOne.classList[2].slice(5));
    //console.log("after dot2 : " + elDiceTwo.classList[2].slice(5));

    return [diceOne, diceTwo];
}

function checkTextbox() {
    var betMoney = document.getElementById('betMoney').value;
    console.log(betMoney);
    if (betMoney < 5) {
    }
}

function calculateOdds(bet1, bet2, bet3) {
    var odds = 1;
    if (bet1 === 'odd' || bet1 === 'even') {
        odds = odds * 1.93;
    }
    if (bet2 === 'tie') {
        odds = odds * 4.5;
    }
    if (bet2 === 'red' || bet2 === 'blue') {
        odds = odds * 1.93;
    }
    if (bet3 === 'seven') {
        odds = odds * 4.5;
    }
    if (bet3 === 'under' || bet3 === 'over') {
        odds = odds * 1.93;
    }
    console.log(odds);
    return odds;
}

function checkOE(oe, total) {
    var result = false;
    if (oe === 'odd' && total % 2 === 1) {
        result = true;
    }
    if (oe === 'even' && total % 2 === 0) {
        result = true;
    }
    return result;
}

function checkRB(rb, red, blue) {
    var result = false;
    if (rb === 'red' && red > blue) {
        result = true;
    }
    if (rb === 'blue' && blue > red) {
        result = true;
    }
    if (rb === 'tie' && blue === red) {
        result = true;
    }
    return result;
}

function checkUO(uo, total) {
    var result = false;
    if (uo === 'under' && total < 7) {
        result = true;
    }
    if (uo === 'over' && total > 7) {
        result = true;
    }
    if (uo === 'seven' && total === 7) {
        result = true;
    }
    return result;
}

var curMoney = $('#curMoney').val();
var betMoney = $('#betMoney').val();

elComeOut.onclick = function () {
    var oe = $('[name="oe"]:checked').val();
    var rb = $('[name="rb"]:checked').val();
    var uo = $('[name="uo"]:checked').val();
    console.log(oe + " " + rb + " " + uo);
    var curMoney = $('#curMoney').html();
    var betMoney = $('#betMoney').val();
    console.log(curMoney + " " + betMoney + " " + newMoney);
    if (betMoney < 5) {
        alert("You can't bet less than $5!");
    }
    else if (!$('.bets input[type="checkbox"]').is(':checked')) {
        alert("You have to check at least one box!");
    }
    else if (parseInt(curMoney) < parseInt(betMoney)) {
        alert("You can't bet more money than you have!");
    }
    else {
        var newMoney = curMoney - betMoney;
        newMoney = Math.floor(newMoney * 100) / 100;
        balance.innerHTML = newMoney;
        $('#curMoney').html(newMoney);
        updateCoin(newMoney);
        var numbers = rollDice();
        var red = numbers[0];
        var blue = numbers[1];
        var total = red + blue;
        var result = true;
        var odds = calculateOdds(oe, rb, uo);
        if (oe != undefined) {
            result = result & checkOE(oe, total);
            console.log(result);
        }
        if (rb != undefined) {
            result = result & checkRB(rb, red, blue);
            console.log(result);
        }
        if (uo != undefined) {
            result = result & checkUO(uo, total);
            console.log(result);
        }
        if (result === 1) {
            newMoney = newMoney + betMoney * odds;
            newMoney = Math.floor(newMoney * 100) / 100;
            balance.innerHTML = newMoney;
            $('#curMoney').html(newMoney);
            updateCoin(newMoney);
        }
    }
};

$("#odd").on('click', function () {
    var $box = $(this);
    if ($("#tie").is(":checked")) {
        alert("You can't bet odd and tie at the same time");
        $box.prop("checked", true);
        $("#tie").prop("checked", false);
    }
});

$("#tie").on('click', function () {
    var $box = $(this);
    if ($("#odd").is(":checked")) {
        alert("You can't bet odd and tie at the same time");
        $box.prop("checked", true);
        $("#odd").prop("checked", false);
    }
    if ($("#seven").is(":checked")) {
        alert("You can't bet seven and tie at the same time");
        $box.prop("checked", true);
        $("#seven").prop("checked", false);
    }
});

$("#even").on('click', function () {
    var $box = $(this);
    if ($("#seven").is(":checked")) {
        alert("You can't bet even and seven at the same time");
        $box.prop("checked", true);
        $("#seven").prop("checked", false);
    }
});

$("#seven").on('click', function () {
    var $box = $(this);
    if ($("#even").is(":checked")) {
        alert("You can't bet even and seven at the same time");
        $box.prop("checked", true);
        $("#even").prop("checked", false);
    }
    if ($("#tie").is(":checked")) {
        alert("You can't bet tie and seven at the same time");
        $box.prop("checked", true);
        $("#tie").prop("checked", false);
    }
});

$("input:checkbox").on('click', function () {
    var $box = $(this);
    if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
});

/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////

