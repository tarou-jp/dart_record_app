<html>

<head>
  <meta charset="UTF-8">
  <title>user_info</title>
  <link rel="stylesheet" href="./public/css/delete.css">
</head>

<body>
  <?php
  $host = "localhost";
  $mysqli = new mysqli($host, "s2210573", "s2210573new", "s2210573");
  if ($mysqli->connect_error) {
    die("MySQL 接続エラー.<br />");
  } else {
    $mysqli->set_charset("utf8"); // utf8 コードを利用するときにはこれが必要                                                        
  }

  $game_id = $_GET["game_id"];

  $success = True;
  $sql = "DELETE FROM  record WHERE  record.game_id = " . $game_id;
  print($sql);
  $mysqli->query($sql) or (die("削除できませんでした") && $success = False);

  $sql = "DELETE FROM game WHERE game.game_id = " . $game_id;
  print($sql);

  if ($success) {
    $mysqli->query($sql) or die("削除できませんでした");
  }

  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit;

  ?>

</body>
</thml>