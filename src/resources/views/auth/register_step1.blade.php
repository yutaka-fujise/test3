<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>

<div class="bg">
  <div class="card">
    <h1 class="logo">PiGLy</h1>

    <p class="title">新規会員登録</p>
    <p class="step">STEP1 アカウント情報の登録</p>

    <form>
      <div class="form-group">
        <label>お名前</label>
        <input type="text" placeholder="名前を入力">
      </div>

      <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" placeholder="メールアドレスを入力">
      </div>

      <div class="form-group">
        <label>パスワード</label>
        <input type="password" placeholder="パスワードを入力">
      </div>

      <button type="submit" class="btn">次に進む</button>
    </form>

    <a href="#" class="login-link">ログインはこちら</a>
  </div>
</div>

</body>
</html>
