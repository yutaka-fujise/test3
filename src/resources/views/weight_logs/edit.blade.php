<!DOCTYPE html>
<html lang="ja">
    
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/edit.css') }}" />
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

  <form method="POST" action="{{ route('weight_logs.update', $log->id) }}">
    @csrf
    @method('PUT')

  <div class="form-group">
    <label>日付</label>
    <input type="date" name="date"
      value="{{ old('date', $log->date) }}">
      @error('date') <p class="error">{{ $message }}</p> @enderror
  </div>

  <div class="form-group unit">
    <label>体重</label>
    <div class="input-unit">
      <input type="number" step="0.1" name="weight"
        value="{{ old('weight', $log->weight) }}">
        @error('weight') <p class="error">{{ $message }}</p> @enderror
      <span>kg</span>
    </div>
  </div>

  <div class="form-group unit">
    <label>摂取カロリー</label>
    <div class="input-unit">
      <input type="number" name="calorie"
        value="{{ old('calorie', $log->calories) }}">
        @error('calorie') <p class="error">{{ $message }}</p> @enderror
      <span>cal</span>
    </div>
  </div>

  <div class="form-group">
    <label>運動時間</label>
    <input type="time" name="exercise_time"
      value="{{ old('exercise_time', $log->exercise_time) }}">
      @error('exercise_time') <p class="error">{{ $message }}</p> @enderror
  </div>

  <div class="form-group">
    <label>運動内容</label>
    <textarea name="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
    @error('exercise_content') <p class="error">{{ $message }}</p> @enderror
  </div>

  <div class="actions">
    <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
    <button type="submit" class="btn-primary">更新</button>
    <button type="submit" form="delete-form" class="btn-delete">🗑</button>
  </div>
  </form>

  <form id="delete-form" method="POST"
  action="{{ route('weight_logs.destroy', $log->id) }}">
  @csrf
  @method('DELETE')
  </form>
  </div>
</main>

</body>
</html>
