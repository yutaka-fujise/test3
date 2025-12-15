<!DOCTYPE html>
<html lang="ja">
    
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/weight_log.css') }}" />
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
    <h2 class="page-title">Weight Log</h2>

    <form>
      <div class="form-group">
        <label>日付</label>
        <input type="date" value="2024-01-01">
      </div>

      <div class="form-group unit">
        <label>体重</label>
        <div class="input-unit">
          <input type="number" step="0.1" value="50.0">
          <span>kg</span>
        </div>
      </div>

      <div class="form-group unit">
        <label>摂取カロリー</label>
        <div class="input-unit">
          <input type="number" value="1200">
          <span>cal</span>
        </div>
      </div>

      <div class="form-group">
        <label>運動時間</label>
        <input type="time" value="00:00">
      </div>

      <div class="form-group">
        <label>運動内容</label>
        <textarea placeholder="運動内容を追加"></textarea>
      </div>

      <div class="actions">
        <button type="button" class="btn-back">戻る</button>
        <button type="submit" class="btn-primary">更新</button>
        <button type="button" class="btn-delete">🗑</button>
      </div>
    </form>
  </div>
</main>

</body>
</html>
