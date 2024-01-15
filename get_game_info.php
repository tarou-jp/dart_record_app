<html>

<head>
  <meta charset="UTF-8">
  <title>game_info</title>
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
        <td>ゲームID</td>
        <td>ゲームタイプID</td>
        <td>作成日付</td>
        <td>ユーザーID</td>
        <?php
        $host = "localhost";
        $mysqli = new mysqli($host, "s2210573", "s2210573new", "s2210573");
        if ($mysqli->connect_error) {
          die("MySQL 接続エラー.<br />");
        } else {
          $mysqli->set_charset("utf8"); // utf8 コードを利用するときにはこれが必要                          

        }
        $sql = "SELECT * FROM game";
        $res = $mysqli->query($sql);
        while ($row = $res->fetch_array()) {
          print("<tr>");
          print("<td>" . $row["game_id"] . "</td>");
          print("<td>" . $row["game_type_id"] . "</td>");
          print("<td>" . $row["create_at"] . "</td>");
          print("<td>" . $row["user_id"] . "</td>");
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
      <div class="links">
        <a href="#">プライバシーポリシー</a>
        <a href="#">サイトマップ</a>
      </div>
    </div>
  </footer>
</body>

</html>