<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Dart_Web(糸久秀喜)</title>
  <link rel="stylesheet" href="./public/css/create_account.css">
</head>

<body>
  <?php
  $host = "localhost";
  if (!$conn = mysqli_connect($host, "s2210573", "s2210573new")) {
    die("データベース接続エラー.<br />");
  }

  mysqli_select_db($conn, "s2210573");
  mysqli_set_charset($conn, "utf8");


  $condition = "";
  $gakuseki = $_POST['gakuseki'];
  $pass = $_POST['pass'];
  $name = $_POST['name'];
  $is_account = False;

  if ((isset($_POST["gakuseki"])) && ($_POST["gakuseki"] != "") && (isset($_POST["pass"])) && ($_POST["pass"] != "") && (isset($_POST["name"])) && ($_POST["name"] != "")) {
    $gakuseki = mysqli_escape_string($conn, $_POST["gakuseki"]);
    $gakuseki = (int)str_replace("%", "\%", $gakuseki);
    $pass = mysqli_escape_string($conn, $_POST["pass"]);
    $pass = str_replace("%", "\%", $pass);
    $name = mysqli_escape_string($conn, $_POST["name"]);
    $name = str_replace("%", "\%", $name);
    $condition = "user_inf.gakuseki = " . $gakuseki . " AND user_inf.pass = '" . $pass . "'";
  }

  $sql = "SELECT * FROM user WHERE user_inf.user_id = " . $gakuseki;
  $res = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_array($res)) {
    die("すでにアカウントが存在します。");
    $is_account = True;
  }

  $sql = "INSERT INTO user_inf VALUES($gakuseki,'$name','$pass')";
  print($sql);
  $res = mysqli_query($conn, $sql);
  if (!$res) {
    print("登録できませんでした。");
  }

  print($is_account);
  header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/index.html');
  exit();
  ?>
</body>

<head>

</html>