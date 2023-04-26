var balance = 100;
var bet = 0;
var multiplier = 1;
var graphData = [{x: 0, y: 1}];

var canvas = document.getElementById("graph");
var ctx = canvas.getContext("2d");

function drawGraph() {
	ctx.clearRect(0, 0, canvas.width, canvas.height);

	ctx.beginPath();
	ctx.moveTo(0, canvas.height);

	for (var i = 0; i < graphData.length; i++) {
		var x = graphData[i].x / 100 * canvas.width;
		var y = (1 / graphData[i].y) * canvas.height;
		ctx.lineTo(x, y);
	}
	ctx.strokeStyle = "white";
	ctx.stroke();
}

function updateMultiplier() {
	multiplier += Math.random() / 10;
	document.getElementById("multiplier").innerHTML = multiplier.toFixed(2) + "x";
	graphData.push({x: graphData.length, y: multiplier});
	drawGraph();
}

document.getElementById("place-bet").addEventListener("click", function() {
	bet = parseFloat(document.getElementById("bet").value);

	if (isNaN(bet) || bet <= 0 || bet > balance) {
		alert("Invalid bet amount.");
		return;
	}

	balance -= bet;
	document.getElementById("balance").innerHTML = balance.toFixed(2);
});

document.getElementById("cash-out").addEventListener("click", function() {
	if (bet == 0) {
		alert("You have not placed a bet.");
		return;
	}

	var payout = bet * multiplier;
	balance += payout;
	bet = 0;
	multiplier = 1;
	document.getElementById("multiplier").innerHTML = "1.00x";
	document.getElementById("balance").innerHTML = balance.toFixed(2);
	graphData = [{x: 0, y: 1}];
	drawGraph();
	alert("Your payout is $" + payout.toFixed(2));
});

setInterval(function() {
	updateMultiplier();
}, 1000);
