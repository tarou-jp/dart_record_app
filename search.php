<html>

<head>
  <meta charset="UTF-8">
  <title>user_info</title>
  <link rel="stylesheet" href="./public/css/search.css">
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
        <td>日付</td>
        <td>ゲームID</td>
        <td>ゲームtype</td>
        <td>削除</td>
        <td>詳細</td>
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
        $sql = "SELECT * FROM  game , user_inf WHERE ";
        $for_back = "";


        if ((isset($_POST["date"])) && ($_POST["date"] != "")) {
          $date  = $_POST["date"];
          $condition = "game.create_at ='" . $date . "' and game.user_id =user_inf.user_id and user_inf.user_id= " . $user_id;
          $for_back . "&date=" . $date;
        }


        if ((isset($_POST["gameType"])) && ($_POST["gameType"] != "3")) {
          $gameType = $_POST["gameType"];
          $for_back .= "&gameType=" . $gameType;
          if ($condition == "") {
            $condition = "game.game_type_id = " . $gameType . " and game.user_id = user_inf.user_id and user_inf.user_id = " . $user_id;
          } else {
            $$condition = "game.game_type_id = " . $gameType . " game.user_id = user_inf.user_id and user_inf.user_id = " . $user_id;
          }
        }


        if ($condition == "") {
          $condition = "game.user_id = user_inf.user_id and user_inf.user_id=" . $user_id;
        }



        $sql .= $condition;
        $res = $mysqli->query($sql);


        while ($row = $res->fetch_array()) {
          print("<tr>");
          print("<td>" . $row["create_at"] . "</td>");
          if ($row["game_type_id"] == 0) {
            $gameType_ = "01game";
          } else if ($row["game_type_id"] == 1) {
            $gameType_ = "cricket";
          } else {
            $gameType_ = "count-up";
          }
          print("<td>" . $row["game_id"] . "</td>");
          print("<td>" . $gameType_ . "</td>");
          print("<td><a href='http://turkey.slis.tsukuba.ac.jp/~s2210573/delete.php?game_id=" . $row["game_id"] . "'class='delete-button'>削除</button></td>");
          print("<td><a href='http://turkey.slis.tsukuba.ac.jp/~s2210573/detail.php?game_id=" . $row["game_id"] . $for_back . "'class='detail-button'>詳細</button></td>");
          print("</tr>\n");
        }
        $res->free();
        ?>
    </table>
  </div>
  <div class="back">
    <a href="http://turkey.slis.tsukuba.ac.jp/~s2210573/rate.php">前の画面に戻る</a>
  </div>
  <footer>
    <div class="footer-content">
      <div class="copyright">
        © 2023 Your Website. All Rights Reserved.
      </div>
    </div>
  </footer>
</body>

</html>