const symbol = ["🍋", "🍒", "🍊", "🍈", "🍇", "🍉", "💎"];
const weight = [0.25, 0.225, 0.2, 0.15, 0.1, 0.05, 0.025];
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
    if (spins[0] == 6 && spins[1] == 6 && spins[2] == 6){
        alert("YOU ARE THE WINNER!<br>Bonus 10,000 COIN");
        coin += 10000;
        current.innerHTML = "COIN : " + coin;
    } else if ((spins[0] == 5 && spins[1] == 5 && spins[2] == 5) || (spins[0] == 5 && spins[1] == 5 && spins[2] == 6)){
        coin += 2000;
        current.innerHTML = "COIN : " + coin;
    } else if ((spins[0] == 4 && spins[1] == 4 && spins[2] == 4) || (spins[0] == 4 && spins[1] == 4 && spins[2] == 6)){
        coin += 1000;
        current.innerHTML = "COIN : " + coin;
    } else if ((spins[0] == 3 && spins[1] == 3 && spins[2] == 3) || (spins[0] == 3 && spins[1] == 3 && spins[2] == 6)){
        coin += 50;
        current.innerHTML = "COIN : " + coin;
    } else if ((spins[0] == 2 && spins[1] == 2 && spins[2] == 2) || (spins[0] == 2 && spins[1] == 2 && spins[2] == 6)){
        coin += 30;
        current.innerHTML = "COIN : " + coin;
    } else if (spins[0] == 1 && spins[1] == 1 && spins[2] == 1){
        coin += 10;
        current.innerHTML = "COIN : " + coin;
    } else if (spins[0] == 1 && spins[1] == 1){
        coin += 5;
        current.innerHTML = "COIN : " + coin;
    } else if(spins[0] == 1){
        coin += 1;
        current.innerHTML = "COIN : " + coin;
    }
}