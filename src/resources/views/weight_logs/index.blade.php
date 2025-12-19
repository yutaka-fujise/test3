<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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

  <!-- summary -->
  <section class="summary">
    <div class="summary-item">
      <p class="label">目標体重</p>
      <p class="value">
        {{ number_format($user->goal_weight, 1) }}
        <span>kg</span>
      </p>
    </div>

    <div class="summary-item">
      <p class="label">目標まで</p>
      <p class="value {{ $diff > 0 ? 'negative' : '' }}">
        {{ number_format($diff, 1) }}
        <span>kg</span>
      </p>
    </div>

    <div class="summary-item">
      <p class="label">最新体重</p>
      <p class="value">
        {{ number_format($latestWeight, 1) }}
        <span>kg</span>
      </p>
    </div>
  </section>

  <!-- filter -->
  <form method="GET" action="{{ route('weight_logs.search') }}" class="filter">
    <input type="date" name="from" value="{{ request('from') }}">
    <span>〜</span>
    <input type="date" name="to" value="{{ request('to') }}">
    <button class="btn-search">検索</button>

    <a href="{{ route('weight_logs.create') }}" class="btn-primary">
      データ追加
    </a>
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
              <a href="{{ route('weight_logs.show', $log->id) }}" class="edit">
                ✏️
              </a>
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

  <!-- pagination -->
  <div class="pagination">
    {{ $logs->links() }}
  </div>

</main>

</body>
</html>
