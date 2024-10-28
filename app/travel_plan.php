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
    echo ("<hr>");


    require_once('dao/event.php');
    $event = new Event();
    $event_list = $event->searchEventByTravelId($travel_id);


    ?>

    <div class="row">
      <div class="col-4">
        <p>ルート１</p>
        <button class='openModal'>予定を追加する</button>

        <?php
        foreach ($event_list as $event):
          if ($event['route_id'] == 0):
        ?>
            <p>route_id:<?= $event['route_id'] ?></p>
            <b><?= $event_type = $event['is_transport'] ? '移動' : '予定' ?></b>
            <p>時間：<?= $event['start_datetime'] ?> ~ <?= $event['end_datetime'] ?></p>
            <p>場所：<?= $event['place'] ?></p>
            <p>詳細：<?= $event['event_detail'] ?></p>
            <p>料金：<?= $event['charge'] ?></p>
            <hr>
        <?php
          endif;
        endforeach;
        ?>

      </div>

      <div class="col-4">
        <p>ルート２</p>
        <button class='openModal'>予定を追加する</button>

        <?php
        foreach ($event_list as $event):
          if ($event['route_id'] == 1):
        ?>
            <p>route_id:<?= $event['route_id'] ?></p>
            <b><?= $event_type = $event['is_transport'] ? '移動' : '予定' ?></b>
            <p>時間：<?= $event['start_datetime'] ?> ~ <?= $event['end_datetime'] ?></p>
            <p>場所：<?= $event['place'] ?></p>
            <p>詳細：<?= $event['event_detail'] ?></p>
            <p>料金：<?= $event['charge'] ?></p>
            <hr>
        <?php
          endif;
        endforeach;
        ?>

      </div>
    </div>






    <script>
      // PHPの変数をJavaScriptに渡す
      window.lastRouteNumber = <?php echo $lastRouteNumber; ?>;
    </script>

  </div>

  <!-- モーダルウィンドウ -->
  <div id="modal" class="hidden">
    <div id="modal-content">
      <span id="closeModal">&times;</span>
      <!-- モーダル内のタブUI -->
      <div class="tab-container">
        <div class="tab active" data-target="modal-tab-transport">移動</div>
        <div class="tab" data-target="modal-tab-schedule">予定</div>
      </div>
      <!-- タブ１の内容 -->
      <div id="modal-tab-transport" class="tab-content active">
        <div class="money">
          <h2>料金</h2>
          <input type="text" style="width:35%;" name="budget">円

        </div>
        <hr>
        <div class="place-time-container">
          <div class="place">
            <h2>出発地</h2>
            <input type="text" style="width:40%;" name="start">
          </div>
          <div class="time">
            <h2>出発時刻</h2>
            <input type="text" style="width:35%;" name="hour"> :
            <input type="text" style="width:35%;" name="minute">
          </div>
        </div>
        <div class="arrive-time-container">
          <div class="arrive-place">
            <h2>目的地</h2>
            <input type="text" style="width:40%;" name="end">
          </div>
          <div class="arrive-time">
            <h2>到着時刻</h2>
            <input type="text" style="width:35%;" name="hour"> :
            <input type="text" style="width:35%;" name="minute">
          </div>
        </div>
        <hr>
        <div class="transportation">
          <h2>移動手段</h2>
          <select name='vehicle'>
            <option value='car'></option>
            <option value='car'>車</option>
            <option value='airplane'>飛行機</option>
            <option value='ferry'>フェリー</option>
          </select>
        </div>
      </div>

      <!-- タブ2の内容 -->
      <div id="modal-tab-schedule" class="tab-content">
        <div class="addplace">
          <h2>場所を追加</h2>
          <input type="text" style="width:35%;" name="place">
        </div>
        <hr>
        <div class="addtime">
          <h2>時刻</h2>
          <input type="text" style="width:25%;" name="time"> :
          <input type="text" style="width:25%;" name="time">
        </div>
        <hr>
        <div class="addplans">
          <h2>予定</h2>
          <textarea name="plans" cols="25" rows="3"></textarea>
        </div>
      </div>
      <button class="submit" type="button">スケジュールを追加</button>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./scripts/header.js"></script>
</body>

</html>