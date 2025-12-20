<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>

<header class="header">
  <div class="logo">PiGLy</div>
  <div class="header-actions">
    <a href="{{ route('weight_logs.goal_setting') }}" class="btn-outline">目標体重設定</a>
     <button
    class="btn-outline"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    ログアウト
  </button>

  <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
    @csrf
  </form>
  </div>
</header>

<main class="container">

  <!-- summary -->
  <section class="summary">
    <div class="summary-item">
      <p class="label">目標体重</p>
      <p class="value">
    {{ $targetWeight !== null ? number_format($targetWeight, 1) : '0.0' }}
      <span>kg</span></p>
    </div>

    <div class="summary-item">
      <p class="label">目標まで</p>
      <p class="value {{ $diff > 0 ? 'negative' : '' }}">
        {{ number_format($diff, 1) }}<span>kg</span>
      </p>
    </div>

    <div class="summary-item">
      <p class="label">最新体重</p>
      <p class="value">{{ number_format($latestWeight, 1) }}<span>kg</span></p>
    </div>
  </section>

  <!-- filter -->
  <form method="GET" action="{{ route('weight_logs.search') }}" class="filter">
    <input type="date" name="from">
    <span>〜</span>
    <input type="date" name="to">
    <button class="btn-search">検索</button>

    <button type="button" id="openModal" class="btn-primary">
      データ追加
    </button>
  </form>

  <!-- table -->
  <section class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>日付</th>
          <th>体重</th>
          <th>食事摂取カロリー</th>
          <th>運動時間</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($logs as $log)
          <tr>
            <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
            <td>{{ number_format($log->weight, 1) }}kg</td>
            <td>{{ $log->calorie }}cal</td>
            <td>{{ $log->exercise_time }}</td>
            <td>
              <a href="{{ route('weight_logs.edit', $log->id) }}">✏️</a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">データがありません</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </section>

  <div class="pagination">
    {{ $logs->links() }}
  </div>

</main>

<!-- modal -->
<div id="modal" class="modal">
  <div class="modal-content">
    <h2>Weight Logを追加</h2>

    <form method="POST" action="{{ route('weight_logs.store') }}">
      @csrf

      <div class="form-row">
        <label>日付 <span class="required">必須</span></label>
        <input type="date" name="date" required>
      </div>

      <div class="form-row">
        <label>体重 <span class="required">必須</span></label>
        <input type="number" step="0.1" name="weight" required>
      </div>

      <div class="form-row">
        <label>摂取カロリー <span class="required">必須</span></label>
        <input type="number" name="calorie" required>
      </div>

      <div class="form-row">
        <label>運動時間 <span class="required">必須</span></label>
        <input type="time" name="exercise_time" required>
      </div>

      <div class="form-row">
        <label>運動内容</label>
        <textarea name="exercise_content"></textarea>
      </div>

      <div class="modal-buttons">
        <button type="button" id="closeModal">戻る</button>
        <button type="submit">登録</button>
      </div>
    </form>
  </div>
</div>

<script>
  const modal = document.getElementById('modal');
  const openBtn = document.getElementById('openModal');
  const closeBtn = document.getElementById('closeModal');

  openBtn.addEventListener('click', () => {
    modal.style.display = 'flex';   // ← ここ重要
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });
</script>

</body>
</html>
