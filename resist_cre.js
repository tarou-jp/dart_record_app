var clickArea = document.getElementById("clickArea");
var score_id = 1;
const url = new URL(window.location.href);
const params = url.searchParams;
const gameId = params.get('gameId');
const round_num = params.get('round_num');
var scores = [0, 0, 0];
console.log(round_num);

clickArea.addEventListener("click", function (event) {
	var rect = clickArea.getBoundingClientRect();
	var centerX = rect.width / 2; // clickAreaの中心のX座標
	var centerY = rect.height / 2; // clickAreaの中心のY座標

	var x = event.clientX - rect.left;
	var y = event.clientY - rect.top;

	// clickAreaの中心を原点として座標変換
	var r = Math.sqrt(Math.pow(x - centerX, 2) + Math.pow(y - centerY, 2)); // 極座標の半径
	var th = Math.atan2(y - centerY, x - centerX) + 3.3; // 極座標の角度（ラジアン）

	console.log("クリックした座標: 極座標 r=" + r + ", θ=" + th);
	var pre_score = 0;

	if (th >= 0.3 && th < 1.56) {
		pre_score = 0;
	} else if (th >= 1.56 && th < 1.89) {
		pre_score = 1;
	} else if (th >= 1.89 && th < 2.20) {
		pre_score = 0;
	} else if (th >= 2.20 && th < 2.53) {
		pre_score = 1;
	} else if (th >= 2.53 && th < 3.79) {
		pre_score = 0;
	} else if (th >= 3.79 && th < 4.08) {
		pre_score = 1;
	} else if (th >= 4.08 && th < 4.40) {
		pre_score = 0;
	} else if (th >= 4.40 && th < 4.71) {
		pre_score = 1;
	} else if (th >= 4.71 && th < 5.03) {
		pre_score = 0;
	} else if (th >= 5.03 && th < 5.31) {
		pre_score = 1;
	} else if (th >= 5.31 && th < 5.63) {
		pre_score = 0;
	} else if (th >= 5.63 && th < 5.95) {
		pre_score = 1;
	} else {
		pre_score = 0;
	}

	var score = 0;

	if (r >= 0 && r < 9) {
		score = 2;
	} else if (r >= 9 && r < 27) {
		score = 1;
	} else if (r >= 27 && r < 137) {
		score = pre_score;
	} else if (r >= 137 && r < 160) {
		score = pre_score * 3;
	} else if (r >= 160 && r < 225) {
		score = pre_score;
	} else if (r >= 225 && r < 247) {
		score = pre_score * 2;
	}

	console.log("今回の得点は" + score + "でした");
	if (score_id <= 3) {
		scores[score_id - 1] = score;
		var scoreElement = document.getElementById('score' + score_id);
		scoreElement.textContent = "得点: " + score;

		score_id++;
	}
});


document.getElementById("undoButton1").addEventListener("click", function () {
	if (score_id >= 2) {
		score_id--;
		console.log(score_id);
		var scoreElement = document.getElementById('score' + score_id);
		scoreElement.textContent = "得点: 0";
		scores[score_id - 1] = 0;
	}

});

document.getElementById("registerButton").addEventListener("click", function () {
	window.location.href = "http://turkey.slis.tsukuba.ac.jp/~s2210573/create_cre_score.php?gameId=" + gameId + "&round_num=" + round_num + "&score1=" + scores[0] + "&score2=" + scores[1] + "&score3=" + scores[2];
});

document.getElementById("finishButton").addEventListener("click", function () {
	window.location.href = "http://turkey.slis.tsukuba.ac.jp/~s2210573/create_cre_score.php?gameId=" + gameId + "&round_num=" + round_num + "&score1=" + scores[0] + "&score2=" + scores[1] + "&score3=" + scores[2] + "&is_final=true";
});