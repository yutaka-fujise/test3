<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>新規会員登録</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>

<div class="bg">
  <div class="card">
    <h1 class="logo">PiGLy</h1>

    <p class="title">新規会員登録</p>
    <p class="step">STEP1 アカウント情報の登録</p>

    <form method="POST" action="{{ route('register.step1.store') }}">
      @csrf

      <div class="form-group">
        <label>お名前</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="名前を入力">
        @error('name')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
        @error('email')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label>パスワード</label>
        <input type="password" name="password" placeholder="パスワードを入力">
        @error('password')
          <p class="error">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="btn">次に進む</button>
    </form>

    <a href="/login" class="login-link">ログインはこちら</a>
  </div>
</div>

</body>
</html>
