<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>目標体重設定</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/goal.css') }}" />
</head>

<body>

<header class="header">
  <div class="logo">PiGLy</div>
  <div class="header-actions">
    <a href="{{ route('weight_logs.goal_setting') }}" class="btn-outline">
      目標体重設定
    </a>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn-outline">ログアウト</button>
    </form>
  </div>
</header>

<main class="container">
  <div class="card">
    <h2 class="page-title">目標体重設定</h2>

    {{-- ★ ここから Laravel 対応 --}}
    <form method="POST" action="{{ route('weight_logs.goal_update') }}">
      @csrf

      <div class="form-group unit">
        <input
          type="number"
          step="0.1"
          name="goal_weight"
          value="{{ old('goal_weight', $user->goal_weight) }}"
        >
        <span>kg</span>
      </div>

      @error('goal_weight')
        <p class="error">{{ $message }}</p>
      @enderror

      <div class="actions">
        <a href="{{ route('weight_logs.index') }}" class="btn-back">
          戻る
        </a>
        <button type="submit" class="btn-primary">
          更新
        </button>
      </div>
    </form>
  </div>
</main>

</body>
</html>
