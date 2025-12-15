<!DOCTYPE html>
<html lang="ja">
    
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/goal_weight.css') }}" />
</head>

<body>

<header class="header">
  <div class="logo">PiGLy</div>
  <div class="header-actions">
    <button class="btn-outline">目標体重設定</button>
    <button class="btn-outline">ログアウト</button>
  </div>
</header>

<main class="container">
  <div class="card">
    <h2 class="page-title">目標体重設定</h2>

    <form>
      <div class="form-group unit">
        <input type="number" step="0.1" value="46.5">
        <span>kg</span>
      </div>

      <div class="actions">
        <button type="button" class="btn-back">戻る</button>
        <button type="submit" class="btn-primary">更新</button>
      </div>
    </form>
  </div>
</main>

</body>
</html>
