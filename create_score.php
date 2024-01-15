<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Dart_Web(糸久秀喜)</title>
  <link rel="stylesheet" href="./public/css/signin.css">
</head>

<body>
  <h>hhh</h>
  <?php
  $host = "localhost";
  if (!$conn = mysqli_connect($host, "s2210573", "s2210573new")) {
    die("データベース接続エラー.<br />");
  }

  mysqli_select_db($conn, "s2210573");
  mysqli_set_charset($conn, "utf8");

  session_start();
  $user_id = $_SESSION['user_id'];
  $gameId = $_GET["gameId"];
  $round_num = $_GET["round_num"];
  $score1 = $_GET["score1"];
  $score2 = $_GET["score2"];
  $score3 = $_GET["score3"];

  $scores = array($score1, $score2, $score3);

  for ($i = 1; $i <= 3; $i++) {
    $gameType = $_GET["gameType"];
    $sql = "INSERT INTO record VALUES(" . $scores[$i - 1] . ",$round_num," . $i . ",$gameId)";
    print($sql);
    $res = mysqli_query($conn, $sql);
    if (!$res) {
      print("登録できませんでした。");
    }
  }

  $round_num++;
  if (isset($_GET["is_final"])) {
    header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/rate.php');
    exit();
  } else {
    header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/resist.php?gameId=' . $gameId . '&round_num=' . $round_num);
    exit();
  }
  ?>

</body>

</html>