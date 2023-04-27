var current = document.getElementById("current");
var balance_ui = document.getElementById("balance_ui")
var bet = 0;
var multiplier = 1;
var graphData = [{ x: 0, y: 1 }];
var timer = 10;
var balance;
var count = 0;

var crashModal = document.getElementById("modal");

document.getElementById("bet").disabled = false;
document.getElementById("place-bet").disabled = false;
document.getElementById("cash-out").disabled = true;

var canvas = document.getElementById("graph");
var ctx = canvas.getContext("2d");

var xhr = new XMLHttpRequest();
xhr.open('GET', '../Slot_Machine/balance.php');
xhr.onload = function () {
    if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        coin = response.coin;
        balance = coin;
        current.innerHTML = "Balance: $" + coin;
        balance_ui.innerHTML = coin;
        console.log('Request failed.  Returned status of ' + xhr.status);
    }
};
xhr.send();

function updateCoin(coin) {
    fetch('../Slot_Machine/updatecoin.php', {
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

function drawGraph() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.beginPath();
    ctx.moveTo(0, canvas.height);

    var a = 0.001;

    for (var i = 0; i < graphData.length; i++) {

        var x = (graphData[i].x / 100) * canvas.width;
        var y = canvas.height - (a * x * x);
        a *= 0.99;
        ctx.lineTo(x, y);

        if (i % 5 === 0) {
            // Draw labels for data points
            ctx.font = "12px Arial";
            ctx.fillStyle = "white";
            ctx.textAlign = "center";
            ctx.fillText(graphData[i].y.toFixed(2), x, y - 10);
        }
    }
    ctx.strokeStyle = "white";
    ctx.stroke();
}


function updateMultiplier() {
    if (timer > 0) {
        timer--;
        return;
    }

    document.getElementById("bet").disabled = true;
    document.getElementById("place-bet").disabled = true;
    document.getElementById("cash-out").disabled = false;
    multiplier += (Math.random() * 0.2 + 0.1);
    document.getElementById("multiplier").innerHTML = multiplier.toFixed(2) + "x";
    graphData.push({ x: graphData.length, y: multiplier });
    drawGraph();

    if (Math.random() < 0.07) {
        endGame();
    }
}

document.getElementById("place-bet").addEventListener("click", function () {
    if (bet > 0) {
        alert("You have already placed a bet.");
        return;
    }
    bet = parseFloat(document.getElementById("bet").value);

    if (isNaN(bet) || bet <= 0 || bet > balance) {
        alert("Invalid bet amount.");
        return;
    }

    balance -= bet;
    coin = balance;
    updateCoin(coin)
    document.getElementById("current").innerHTML = "Balance: $" + balance.toFixed(2);
    document.getElementById("balance_ui").innerHTML = balance.toFixed(2);
});


document.getElementById("cash-out").addEventListener("click", function () {
    if (bet == 0) {
        alert("You have not placed a bet.");
        return;
    }

    var payout = bet * multiplier;
    balance += payout;
    bet = 0;
    multiplier = 1;
    document.getElementById("multiplier").innerHTML = "1.00x";
    document.getElementById("current").innerHTML = "Balance: $" + balance.toFixed(2);
    document.getElementById("balance_ui").innerHTML = balance.toFixed(2);
    graphData = [{ x: 0, y: 1 }];
    drawGraph();
    alert("Your payout is $" + payout.toFixed(2));
    document.getElementById("bet").disabled = false;
    document.getElementById("place-bet").disabled = false;
    document.getElementById("cash-out").disabled = true;
    coin = balance;
    updateCoin(coin)
    startBettingTime();
});

function startBettingTime() {
    count += 1;
    timer = 11;
    var countdown = setInterval(function () {
        document.getElementById("timer").innerHTML = Math.floor(timer / 2);
        if (timer === 0) {
            clearInterval(countdown);
            updateMultiplier();
            document.getElementById("timer").innerHTML = "";
        }
    }, 500);
}

function endGame() {
    crashModal.style.display = "block";
    document.getElementById("multiplier2").innerHTML = multiplier.toFixed(2) + "x";
    openModal(crashModal);
    var payout = bet;
    multiplier = 1;
    document.getElementById("multiplier").innerHTML = "1.00x";
    graphData = [{ x: 0, y: 1 }];
    drawGraph();
    if (bet > 0) {
        alert("Your lost your bet amount" + payout.toFixed(2));
    }
    bet = 0;
    document.getElementById("bet").disabled = false;
    document.getElementById("place-bet").disabled = false;
    document.getElementById("cash-out").disabled = true;
    startBettingTime();
}

startBettingTime();

setInterval(function () {
    updateMultiplier();
}, 500);


overlay.addEventListener('click', () => {
    const modals = document.querySelectorAll('.modal.active')
    modals.forEach(modal => {
        closeModal();
    })
})

function openModal(modal) {
    if (modal == null) return
    modal.classList.add('active');
    overlay.classList.add('active');
}

function closeModal() {
    crashModal.style.display = "none";
}
