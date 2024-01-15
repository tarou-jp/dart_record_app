<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Dart_Web(糸久秀喜)</title>
  <link rel="stylesheet" href="./public/css/signin.css">
</head>

<body>
  <?php
  $host = "localhost";
  if (!$conn = mysqli_connect($host, "s2210573", "s2210573new")) {
    die("データベース接続エラー.<br />");
  }

  mysqli_select_db($conn, "s2210573");
  mysqli_set_charset($conn, "utf8");

  session_start();
  $user_id = $_SESSION['user_id'];

  $objDateTime = new DateTime();
  $now = $objDateTime->format('Y-m-d');
  print($now);

  // 新しい id を入手
  $sql = "select max(game_id) as max_id from game"; // 現在最大の id
  $res = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($res)) {
    $gameId = $row["max_id"] + 1;
  }

  print("ac" . $gameId . "aa");
  $gameType = $_GET["gameType"];
  $sql = "INSERT INTO game VALUES($gameId,$gameType,'$now',$user_id)";
  print($sql);
  $res = mysqli_query($conn, $sql);
  if (!$res) {
    print("登録できませんでした。");
  }

  if ($gameType == 1) {
    header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/resist_cre.php?gameId=' . $gameId . '&round_num=1');
    exit();
  } else {
    header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/resist.php?gameId=' . $gameId . '&round_num=1');
    exit();
  }
  ?>

</body>

</html>