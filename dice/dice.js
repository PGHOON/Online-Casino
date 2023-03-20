var elDiceOne = document.getElementById('dice1');
var elDiceTwo = document.getElementById('dice2');
var elComeOut = document.getElementById('roll');
var rollButton = document.querySelector('.dice-button');

var showClasses = ['show-1', 'show-2', 'show-3', 'show-4', 'show-5', 'show-6'];

//disables button when dice is rolling
function enableButton(button) {
    button.disabled = false;
}
elComeOut.onclick = function () { rollDice(); };

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

async function rollDice() {
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

    return "true";
}