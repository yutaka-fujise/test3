<!DOCTYPE html>
<html lang="ja">
    
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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

  <!-- summary -->
  <section class="summary">
    <div class="summary-item">
      <p class="label">目標体重</p>
      <p class="value">45.0 <span>kg</span></p>
    </div>
    <div class="summary-item">
      <p class="label">目標まで</p>
      <p class="value negative">-1.5 <span>kg</span></p>
    </div>
    <div class="summary-item">
      <p class="label">最新体重</p>
      <p class="value">46.5 <span>kg</span></p>
    </div>
  </section>

  <!-- filter -->
  <section class="filter">
    <input type="date">
    <span>〜</span>
    <input type="date">
    <button class="btn-search">検索</button>
    <button class="btn-primary">データ追加</button>
  </section>

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
        <tr>
          <td>2023/11/26</td>
          <td>46.5kg</td>
          <td>1200cal</td>
          <td>00:15</td>
          <td><span class="edit">✏️</span></td>
        </tr>
        <tr>
          <td>2023/11/25</td>
          <td>46.5kg</td>
          <td>1200cal</td>
          <td>00:15</td>
          <td><span class="edit">✏️</span></td>
        </tr>
      </tbody>
    </table>
  </section>

  <!-- pagination -->
  <div class="pagination">
    <span>&lt;</span>
    <span class="active">1</span>
    <span>2</span>
    <span>3</span>
    <span>&gt;</span>
  </div>

</main>

</body>
</html>
