<html>

<head>
  <meta charset="UTF-8">
  <title>record_info</title>
  <link rel="stylesheet" href="./public/css/delete.css">
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
        <td>得点</td>
        <td>ラウンド数</td>
        <td>スロー数</td>
        <td>ゲームID</td>
        <?php
        $host = "localhost";
        $mysqli = new mysqli($host, "s2210573", "s2210573new", "s2210573");
        if ($mysqli->connect_error) {
          die("MySQL 接続エラー.<br />");
        } else {
          $mysqli->set_charset("utf8"); // utf8 コードを利用するときにはこれが必要                                                          \

        }
        $sql = "SELECT * FROM record";
        $res = $mysqli->query($sql);
        while ($row = $res->fetch_array()) {
          print("<tr>");
          print("<td>" . $row["score"] . "</td>");
          print("<td>" . $row["round_num"] . "</td>");
          print("<td>" . $row["throw_num"] . "</td>");
          print("<td>" . $row["game_id"] . "</td>");
          print("</tr>\n");
        }
        $res->free();
        ?>
    </table>
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