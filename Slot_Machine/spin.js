const symbol = ["🍒", "🍊", "🍋", "🍇", "🍉"];
var slot1 = document.getElementById("slot1");
var slot2 = document.getElementById("slot2");
var slot3 = document.getElementById("slot3");


// Coin
var current = document.getElementById("current");
var coin = 20;

function spin() {
    coin--;
    current.innerHTML = "COIN : " + coin;
    var spin1 = Math.floor(Math.random() * symbol.length);
    var spin2 = Math.floor(Math.random() * symbol.length);
    var spin3 = Math.floor(Math.random() * symbol.length);

    slot1.textContent = symbol[spin1];
    slot2.textContent = symbol[spin2];
    slot3.textContent = symbol[spin3];
    if (spin1 == spin2 && spin2 == spin3) {
        alert("You win! bonus 10 COIN!!!");
        coin += 10;
        current.innerHTML = "COIN : " + coin;
    }
}