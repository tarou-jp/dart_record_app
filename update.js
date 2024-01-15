function updateScore(event, roundNum, throwNum, gameId) {
    event.preventDefault();
    console.log('scoreInput_' + gameId + "_" + roundNum + "_" + throwNum);
    console.log(roundNum, throwNum, gameId);
    var scoreInput = document.getElementById('scoreInput_' + gameId + "_" + roundNum + "_" + throwNum);
    var scoreValue = scoreInput.value;
    console.log('scoreInput_' + gameId + "_" + roundNum + "_" + throwNum);
    var updateUrl = 'http://turkey.slis.tsukuba.ac.jp/~s2210573/update.php?score=' + scoreValue + '&round_num=' + roundNum + '&throw_num=' + throwNum + '&game_id=' + gameId;
    window.location.href = updateUrl;
}