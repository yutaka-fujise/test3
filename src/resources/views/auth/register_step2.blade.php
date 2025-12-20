<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register STEP2</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register_step2.css') }}" />
</head>

<body>

<div class="bg">
  <div class="card">
    <h1 class="logo">PiGLy</h1>

    <p class="title">新規会員登録</p>
    <p class="step">STEP2 体重データの入力</p>

    <form method="POST" action="{{ route('register.step2.store') }}">
      @csrf

      {{-- 現在の体重 --}}
      <div class="form-group">
        <label>現在の体重</label>

        <div class="input-with-unit">
          <input
            type="number"
            step="0.1"
            name="current_weight"
            value="{{ old('current_weight') }}"
            placeholder="現在の体重を入力">
          <span>kg</span>
        </div>

        @foreach ($errors->get('current_weight') as $message)
          <p class="error-text">{{ $message }}</p>
        @endforeach
      </div>

      {{-- 目標の体重 --}}
      <div class="form-group">
        <label>目標の体重</label>

        <div class="input-with-unit">
          <input
            type="number"
            step="0.1"
            name="goal_weight"
            value="{{ old('goal_weight') }}"
            placeholder="目標の体重を入力">
          <span>kg</span>
        </div>

        @foreach ($errors->get('goal_weight') as $message)
          <p class="error-text">{{ $message }}</p>
        @endforeach
      </div>

      <button type="submit" class="btn">アカウント作成</button>
    </form>
  </div>
</div>

</body>
</html>
