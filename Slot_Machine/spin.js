const images = [
    "symbols/lemon.png",
    "symbols/cherry.png",
    "symbols/apple.png",
    "symbols/plum.png",
    "symbols/clover.png",
    "symbols/coin.png",
    "symbols/bell.png"
  ];


const symbol = images;
//["🍋", "🍒", "🍊", "🍈", "🍇", "🍉", "💎"];
const weight = [0.25, 0.225, 0.2, 0.15, 0.1, 0.05, 0.025];
var slot1 = document.getElementById("slot1");
var slot2 = document.getElementById("slot2");
var slot3 = document.getElementById("slot3");

// Coin
var current = document.getElementById("current");
var coin = 0;

var xhr = new XMLHttpRequest();
xhr.open('GET', 'balance.php');
xhr.onload = function() {
    if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        coin = response.coin;
        current.innerHTML = "COIN : " + coin;
    } else {
        console.log('Request failed.  Returned status of ' + xhr.status);
    }
};
xhr.send();

function updateCoin(coin) {
    fetch('updatecoin.php', {
        method: 'POST',
        body: JSON.stringify({ coin: coin }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error(error));
}

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

    // set the src attribute of each img element to the corresponding image source in the images array
    slot1.setAttribute('src', images[spins[0]]);
    slot2.setAttribute('src', images[spins[1]]);
    slot3.setAttribute('src', images[spins[2]]);

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
    };

    updateCoin(coin);
}