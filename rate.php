<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Dart_Web(糸久秀喜)</title>
  <link rel="stylesheet" href="./public/css/rate.css">

</head>

<body>
  <main>

    <?php
    $host = "localhost";
    if (!$conn = mysqli_connect($host, "s2210573", "s2210573new")) {
      die("データベース接続エラー.<br />");
    }
    mysqli_select_db($conn, "s2210573");
    mysqli_set_charset($conn, "utf8");
    $condition = "";

    session_start();

    $is_account = False;

    if ((isset($_POST["gakuseki"])) && ($_POST["gakuseki"] != "") && (isset($_POST["pass"])) && ($_POST["pass"] != "")) {
      $gakuseki = mysqli_escape_string($conn, $_POST["gakuseki"]);
      $gakuseki = (int)str_replace("%", "\%", $gakuseki);
      $pass = mysqli_escape_string($conn, $_POST["pass"]);
      $pass = str_replace("%", "\%", $pass);
      $condition = "user_inf.user_id = '" . $gakuseki . "' AND user_inf.pass = '" . $pass . "'";

      $sql = "SELECT * FROM user_inf WHERE " . $condition;
      $res = mysqli_query($conn, $sql);

      if (isset($_COOKIE['PHPSESSID'])) {
        session_regenerate_id();
        unset($_SESSION['user_id']);
      }

      while ($row = mysqli_fetch_array($res)) {
        $user_name = $row["name"];
        $_SESSION['user_id'] = $row["user_id"];
        $is_account = True;
      }
      if (!$is_account) {
        header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/is_account.php');
        exit();
      } else {
        header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/rate.php');
        exit();
      }
    } else if (isset($_COOKIE['PHPSESSID'])) {
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT * FROM record,game,user_inf WHERE record.game_id = game.game_id AND game.user_id = user_inf.user_id AND user_inf.user_id = " . $user_id;
      $res = mysqli_query($conn, $sql);
      $is_account = True;
    }

    $ol_game_ave = 0;
    $ol_game_i = 0;
    $cricket_ave = 0;
    $cricket_i = 0;
    $count_up_ave = 0;
    $count_up_i = 0;

    while ($row = mysqli_fetch_array($res)) {
      $user_name = $row["name"];
      if ($row["game_type_id"] == "0") {
        $ol_game_ave += (int)$row["score"];
        $ol_game_i += 1;
      } else if ($row["game_type_id"] == "1") {
        $cricket_ave += $row["score"];
        $cricket_i += 1;
      } else {
        $count_up_ave += (int)$row["score"];
        $count_up_i += 1;
      }
    }

    if ($ol_game_i != 0) {
      $ol_game_ave = ($ol_game_ave / $ol_game_i);
    }
    if ($cricket_i != 0) {
      $cricket_ave = ($cricket_ave / $cricket_i);
    }
    if ($count_up_i != 0) {
      $count_up_ave = ($count_up_ave / $count_up_i);
    }

    $rate = "C";

    if ($count_up_ave > 32) {
      $rate = "AA";
    } else if ($count_up_ave > 27) {
      $rate = "A";
    } else if ($count_up_ave > 24) {
      $rate = "BB";
    } else if ($count_up_ave > 20) {
      $rate = "B";
    } else if ($count_up_ave > 17) {
      $rate = "CC";
    }


    mysqli_free_result($res);

    if (!$is_account) {
      header('Location: http://turkey.slis.tsukuba.ac.jp/~s2210573/is_account.php');
      exit();
    }

    ?>
    <header class="header">
      <div class="producer_inf">
        <h3><a href="http://turkey.slis.tsukuba.ac.jp/~s2210573/index.html">ダーツ記録管理サイト</a></h3>
        <p>製作者: 糸久秀喜(202210573)</p>
      </div>

      <div class="logout">
        <button class="logout-btn" onclick="location.href='http://turkey.slis.tsukuba.ac.jp/~s2210573/'">ログアウト</button>
      </div>
    </header>


    <section class="ratting_serch">
      <?php
      print("<span class='rating_number'>ユーザー:" . $user_name . "</span>");
      ?>
      <h1>RATING</h1>
      <div class="rating_container">
        <div class="rating_value">
        </div>
        <div class="rating_image">
          <?php
          print("<img src='img/rate_" . $rate . ".png' alt='Rating Image'>");
          ?>
        </div>
        <div class="game_averages">
          <div class="game_title">
            <span class="rating_01GAME_text">01GAME</span>
            <span class="rating_CRICKET_text">CRICKET</span>
            <span class="rating_COUNT-UP_text">COUNT-UP</span>
          </div>
          <div class="game_value">
            <?php
            print("<span class='rating_01GAME_value'>" . number_format($ol_game_ave, 2) . "</span>");
            print("<span class='rating_CRICKET_value'>" . number_format($cricket_ave, 2) . "</span>");
            print("<span class='rating_COUNT-UP_value'>" . number_format($count_up_ave * 24, 0) . "</span>");
            ?>
          </div>
        </div>
      </div>
    </section>

    <section class="data_confirmation">
      <h2>データ登録</h2>
      <p>プレイするゲームを選択してください。</p>
      <div class="button_container">
        <button class="olgame" onclick="location.href='create_game.php?gameType=0'">01GAME</button>
        <button class="cricket" onclick="location.href='create_game.php?gameType=1'">CRICKET</button>
        <button class="count-up" onclick="location.href='create_game.php?gameType=2'">COUNT-UP</button>
      </div>
    </section>

    <section class="search-form-section">
      <h2 class="search-form-section-title">データ検索</h2>
      <div class="search-form-container">
        <form class="search-form" method="post" action="http://turkey.slis.tsukuba.ac.jp/~s2210573/search.php">
          <div class="search-form-group">
            <label for="date-input">日付</label>
            <input type="date" id="date-input" class="search-form-control" name="date">
          </div>
          <div class="search-form-group">
            <label for="select-input">ゲームの種類</label>
            <select id="select-input" class="search-form-control" name="gameType">
              <option value="3">選択なし</option>
              <option value="0">01game</option>
              <option value="1">cricket</option>
              <option value="2">count-up</option>
            </select>
          </div>
          <div class="search-form-group">
            <button type="submit" class="search-submit-button">送信</button>
          </div>
        </form>
      </div>
    </section>

    <section class="about-rate">
      <h2>Ratingとは</h2>
      <p>ダーツのうまさを表す指標の一つであり、以下のrating表に基づいて計算される<br />(実際には計算しているのはスタッツに近いものであるが、このページで独自に定義しているものと思っていただきたい。)<br />本ページではカウントアップの平均点による計算を用いる。<br />本ページ上部のフラグ型の画像がレート、それぞれのゲーム名の下に書いてある数字はゲームの平均スコアである。</p>
      <div class="table-container">
        <table class="rating-table">
          <thead>
            <tr>
              <th>01のスタッツ</th>
              <th>クリケットのスタッツ</th>
              <th>カウントアップの平均点</th>
              <th>Rating</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>0~49.99</td>
              <td>0~1.69</td>
              <td>0~360</td>
              <td>C</td>
            </tr>
            <tr>
              <td>50~59.99</td>
              <td>1.70~2.09</td>
              <td>361~440</td>
              <td>CC</td>
            </tr>
            <tr>
              <td>60~69.99</td>
              <td>2.10~2.49</td>
              <td>441~520</td>
              <td>B</td>
            </tr>
            <tr>
              <td>70~79.99</td>
              <td>2.50~2.89</td>
              <td>521~600</td>
              <td>BB</td>
            </tr>
            <tr>
              <td>80~89.99</td>
              <td>2.70~3.49</td>
              <td>601~720</td>
              <td>A</td>
            </tr>
            <tr>
              <td>90~</td>
              <td>3.50~</td>
              <td>721~</td>
              <td>AA</td>
            </tr>
          </tbody>
          <caption>rating表</caption>
        </table>
      </div>
    </section>


    <footer>
      <div class="footer-content">
        <div class="copyright">
          © 2023 Your Website. All Rights Reserved.
        </div>
      </div>
    </footer>
  </main>
</body>

</html>