<html>

<head>
  <meta charset="UTF-8">
  <title>user_info</title>
  <link rel="stylesheet" href="./public/css/index.css">
</head>

<body>
  <header class="header">

    <div class="producer_inf">
      <h3><a href="http://turkey.slis.tsukuba.ac.jp/~s2210573/index.html">ダーツ記録管理サイト</a></h3>
      <p>製作者: 糸久秀喜(202210573)</p>
    </div>

  </header>

  <div class="sql-table">
    <table border="1">
      <tr>
        <td>ゲームID</td>
        <td>ラウンド数</td>
        <td>スロー数</td>
        <td>得点</td>
        <td>更新</td>
        <?php
        $host = "localhost";
        $mysqli = new mysqli($host, "s2210573", "s2210573new", "s2210573");
        if ($mysqli->connect_error) {
          die("MySQL 接続エラー.<br />");
        } else {
          $mysqli->set_charset("utf8"); // utf8 コードを利用するときにはこれが必要                                                           
        }

        session_start();
        $user_id = $_SESSION['user_id'];

        $condition = "";
        $sql = "SELECT * FROM  game , record WHERE record.game_id = game.game_id ";


        if ((isset($_GET["game_id"])) && ($_GET["game_id"] != "")) {
          $game_id = $_GET["game_id"];
          $condition = "and  game.game_id = " . $game_id;
        }

        $sql .= $condition;

        if ($condition != "") {
          $res = $mysqli->query($sql);
        }

        $max_score = 60;

        while ($row = $res->fetch_array()) {
          if ($row["game_type_id"] == 1) {
            $max_score = 3;
          }
          print("<tr>");
          print("<td>" . $row["game_id"] . "</td>");
          print("<td>" . $row["round_num"] . "</td>");
          print("<td>" . $row["throw_num"] . "</td>");
          print("<td>" . $row["score"] . "</td>");
          print("<td>得点を<input type='number' min='0' max='60'　value='0'  class='update' id='scoreInput_" . $row["game_id"] . "_" . $row["round_num"] . "_" . $row["throw_num"] . "'>に<a class='update-button' onclick='updateScore(event," . $row["round_num"] . ", " . $row["throw_num"] . ", " . $row["game_id"] . ")'>更新</a></td>");
          print("</tr>\n");
        }
        $res->free();

        ?>
    </table>
  </div>
  <div class="back">
    <form method="POST" action="http://turkey.slis.tsukuba.ac.jp/~s2210573/search.php">
      <?php
      if (isset($_GET["date"]) && $_GET["date"] != "") {
        echo "<input type='hidden' value='" . $_GET["date"] . "' name='date'>";
      }
      if (isset($_GET["gameType"]) && $_GET["gameType"] != "") {
        echo "<input type='hidden' value='" . $_GET["gameType"] . "' name='gameType'>";
      }
      ?>
      <input type="submit" value="前の画面に戻る" class="back-button">
    </form>
  </div>
  <footer>
    <div class="footer-content">
      <div class="copyright">
        © 2023 Your Website. All Rights Reserved.
      </div>
    </div>
  </footer>
  <script src="update.js"></script>
</body>

</html>