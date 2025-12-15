<!DOCTYPE html>
<html lang="ja">
    
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>

<div class="bg">
  <div class="card">
    <h1 class="logo">PiGLy</h1>

    <p class="title">ログイン</p>

    <form>
      <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" placeholder="メールアドレスを入力">
      </div>

      <div class="form-group">
        <label>パスワード</label>
        <input type="password" placeholder="パスワードを入力">
      </div>

      <button type="submit" class="btn">ログイン</button>
    </form>

    <a href="#" class="link">アカウント作成はこちら</a>
  </div>
</div>

</body>
</html>
