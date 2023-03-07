const symbol = ["🍒", "🍊", "🍋", "🍇", "🍉", "💎"];
const weight = [0.3, 0.25, 0.225, 0.1, 0.075, 0.05];
var slot1 = document.getElementById("slot1");
var slot2 = document.getElementById("slot2");
var slot3 = document.getElementById("slot3");

// Coin
var current = document.getElementById("current");
var coin = 20;

function spin() {
    coin--;
    current.innerHTML = "COIN : " + coin;
    var spins = [];

    //winning probability
    for (var i = 0; i < 3; i++) {
        var randomNum = Math.random() * 1;
        var spinIndex = 0;
        while (randomNum >= 0) {
          randomNum -= weight[spinIndex];
          spinIndex++;
        }
        spinIndex--;
        spins[i] = spinIndex;
    }
    slot1.textContent = symbol[spins[0]];
    slot2.textContent = symbol[spins[1]];
    slot3.textContent = symbol[spins[2]];

    //reward
    if (spins[0] == spins[1] && spins[1] == spins[2]) {
        alert("You win! bonus 10 COIN!!!");
        coin += 10;
        current.innerHTML = "COIN : " + coin;
    }
}