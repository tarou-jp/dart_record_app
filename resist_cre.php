<html>

<head>
  <meta charset="UTF-8">
  <title>user_info</title>
  <link rel="stylesheet" href="./public/css/resist.css">
</head>

<body>

  <header class="header">
    <div class="producer_inf">
      <h3><a href="http://turkey.slis.tsukuba.ac.jp/~s2210573/index.html">ダーツ記録管理サイト</a></h3>
      <p>製作者: 糸久秀喜(202210573)</p>
    </div>

  </header>

  <div class="image-container">
    <img src="img/home2.jpg" alt="Background Image" class="background-image">
    <p class="tyuui">※矢が刺さった場所をクリックしてください。</p>
    <?php
    print("<h2 class='round'>ラウンド数:" . $_GET["round_num"] . "</h2>");
    ?>
    <div id="clickArea">
      <img src="dart.png" alt="画像">
    </div>
    <div class="scores">
      <div class="score">
        <span>1スロー</span>
        <span id="score1">得点: 0</span>
      </div>
      <div class="score">
        <span>2スロー</span>
        <span id="score2">得点: 0</span>
      </div>
      <div class="score">
        <span>3スロー</span>
        <span id="score3">得点: 0</span>
      </div>
      <div class="buttons">
        <button id="undoButton1">１スロー戻る</button>
        <button id='registerButton'>次のラウンド</button>
        <button id='finishButton'>ゲーム終了</button>
      </div>
    </div>
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

  <script src="resist_cre1.js"></script>
</body>

</html>