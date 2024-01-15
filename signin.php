<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Dart_Web(糸久秀喜)</title>
  <link rel="stylesheet" href="./public/css/signin.css">
</head>

<body>
  <main>
    <header class="header">

      <div class="producer_inf">
        <h3><a href="http://turkey.slis.tsukuba.ac.jp/~s2210573/index.html">ダーツ記録管理サイト</a></h3>
        <p>製作者: 糸久秀喜(202210573)</p>
      </div>

    </header>


    <div class="login-form">
      <div class="login-label">
        <h1>新規アカウント登録</h1>
      </div>
      <form method="POST" action="http://turkey.slis.tsukuba.ac.jp/~s2210573/create_account.php">
        <div class="input-field">
          <label for="gakuseki">学籍番号:</label>
          <input type="number" name="gakuseki" required>
        </div>
        <div class="input-field">
          <label for="username">ユーザー名:</label>
          <input type="text" id="username" name="name" required>
        </div>
        <div class="input-field">
          <label for="password">パスワード:</label>
          <input type="password" id="password" name="pass" required>
        </div>
        <button class="register-button" type="submit">新規登録</button>
      </form>
    </div>
    <div class="register">
      <p>アカウントをお持ちの方は<a href="http://turkey.slis.tsukuba.ac.jp/~s2210573/index.html">ログイン</a>してください。</p>
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