<?php
session_start()
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>旅行計画</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../app/styles/travel_plan.css?<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" href="./styles/header.css" type="text/css">
  <script src="./scripts/travel_pran.js?<?php echo date('YmdHis'); ?>" defer></script>
</head>

<body>
  <header class="header d-flex justify-content-between align-items-center">
    <a href="./home.php" class="nav-item">
      <img src="./assets/logo.png" alt="Site Logo" class="site-logo">
    </a>
    <nav class="nav">
      <div class="nav-item">
        <a href="./mypage.php">
          <img src="./assets/image/user_icon.svg" alt="User Icon" class="icon">
        </a>
      </div>

      <div class="nav-item">
        <a href="#">
          <img src="./assets/image/notification.svg" alt="Notification Icon" class="icon">
        </a>
      </div>
    </nav>
  </header>
  <div class="container">

    <?php
    $travel_id = $_SESSION['travel_id'];
    $lastRouteNumber = 0;


    //旅行データを取得して表示
    $travel_id = $_GET['travel_id'];
    require_once('dao/travel.php');
    $travel = new Travel();
    $travel_data = $travel->findTravelByTravelId($travel_id);

    echo ("travel_id:" . $travel_data['travel_id'] . "<br>");
    echo ("タイトル：" . $travel_data['title'] . "<br>");
    echo ("作成者ID：" . $travel_data['management_id'] . "<br>");
    ?>



    <script>
      // PHPの変数をJavaScriptに渡す
      window.lastRouteNumber = <?php echo $lastRouteNumber; ?>;
    </script>






    <button id='openModal'>予定を追加する</button>
  </div>"

  <!-- モーダル -->
  <div id="modal" class="hidden">
    <div id="modal-content">
      <span id="closeModal">&times;</span>

      <div class="tab-container">
        <div class="tab active" data-target="modal-tab1">移動</div>
        <div class="tab" data-target="modal-tab2">予定</div>
      </div>

      <!-- タブ1：移動 -->
      <form id="scheduleForm1" action="registerEvent.php" method="POST">
        <input type="hidden" name="last_route_number" value="">
        <!--ルートナンバーをjavascriptからpostで受け取る-->
        <input type="hidden" id="routeNumberInput1" name="routeNumber" value="">
        <div id="modal-tab1" class="tab-content active">
          <div class="form-group">
            <label for="budget">料金</label>
            <input type="text" class="form-control" name="budget" placeholder="円">
          </div>
          <div class="form-group">
            <label>出発地</label>
            <input type="text" class="form-control" name="start">
          </div>
          <div class="form-row">
            <div class="col">
              <label>出発時刻</label>
              <input type="text" class="form-control" name="start_hour" placeholder="時">
            </div>
            <div class="col">
              <input type="text" class="form-control" name="start_minute" placeholder="分">
            </div>
          </div>
          <div class="form-group mt-3">
            <label>目的地</label>
            <input type="text" class="form-control" name="end">
          </div>
          <div class="form-row">
            <div class="col">
              <label>到着時刻</label>
              <input type="text" class="form-control" name="end_hour" placeholder="時">
            </div>
            <div class="col">
              <input type="text" class="form-control" name="end_minute" placeholder="分">
            </div>
          </div>
          <div class="form-group mt-3">
            <label>移動手段</label>
            <select class="form-control" name="vehicle" required>
              <option value="" disabled selected>選択してください</option>
              <option value="1">車</option>
              <option value="2">飛行機</option>
              <option value="3">フェリー</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success mt-3">スケジュールを追加</button>
        </div>
      </form>

      <!-- タブ2：予定 -->
      <form id="scheduleForm2" action="registerEvent.php" method="POST">
        <input type="hidden" name="last_route_number" value="">
        <input type="hidden" id="routeNumberInput2" name="routeNumber" value="">
        <div id="modal-tab2" class="tab-content">
          <div class="form-group">
            <label>場所を追加</label>
            <input type="text" class="form-control" name="place">
          </div>
          <div class="form-group mt-3">
            <label>詳細内容</label>
            <input type="text" class="form-control" name="plan_detil">
          </div>
          <div class="form-row">
            <div class="col">
              <label>到着時刻</label>
              <input type="text" class="form-control" name="plan_hour" placeholder="時">
            </div>
            <div class="col">
              <input type="text" class="form-control" name="plan_minute" placeholder="分">
            </div>
          </div>
          <button type="submit" class="btn btn-success mt-3">スケジュールを追加</button>
        </div>
      </form>
    </div>
  </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./scripts/header.js"></script>
</body>

</html>