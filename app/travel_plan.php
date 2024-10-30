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
    //echo ("<hr>");

    require_once('dao/event.php');
    $event = new Event();
    $event_list = $event->searchEventByTravelId($travel_id);

    ?>

    <div class="row">
      <div class="col-4">
        <p>ルート１</p>
        <button class='openModal'>予定を追加する</button>
        <div class="event-list">
          <?php
          foreach ($event_list as $event):
            if ($event['route_id'] == 0):
          ?>
              <p>route_id:<?= $event['route_id'] ?></p>
              <b><?= $event_type = $event['is_transport'] ? '移動' : '予定' ?></b>
              <p>時間：<?= $event['start_datetime'] ?> ~ <?= $event['end_datetime'] ?></p>
              <p>場所：<?= $event['place'] ?></p>
              <p>詳細：<?= $event['detail'] ?></p>
              <p>料金：<?= $event['charge'] ?></p>
              <hr>
          <?php
            endif;
          endforeach;
          ?>
        </div>

      </div>

      <div class="col-4">
        <p>ルート２</p>
        <button class='openModal'>予定を追加する</button>
        <div class="event-list">
          <?php
          foreach ($event_list as $event):
            if ($event['route_id'] == 1):
          ?>
              <p>route_id:<?= $event['route_id'] ?></p>
              <b><?= $event_type = $event['is_transport'] ? '移動' : '予定' ?></b>
              <p>時間：<?= $event['start_datetime'] ?> ~ <?= $event['end_datetime'] ?></p>
              <p>場所：<?= $event['place'] ?></p>
              <p>詳細：<?= $event['detail'] ?></p>
              <p>料金：<?= $event['charge'] ?></p>
              <hr>
          <?php
            endif;
          endforeach;
          ?>
        </div>


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
      <form id="modal-tab-transport" class="tab-content active" action="./registerTransportation.php" method="POST">
        <div class="charge">
          <h2>料金</h2>
          <input type="number" style="width:35%;" name="charge">円
        </div>
        <hr>
        <div class="place-time-container">
          <div class="place">
            <h2>出発地</h2>
            <input type="text" style="width:40%;" name="departure_place">
          </div>
          <div class="time">
            <h2>出発時刻</h2>
            <input type="datetime-local" name="start_datetime" value=<?=date("Y-m-d\TH:i");?>>
          </div>
        </div>
        <div class="arrive-time-container">
          <div class="arrive-place">
            <h2>目的地</h2>
            <input type="text" style="width:40%;" name="arrival_place">
          </div>
          <div class="arrive-time">
            <h2>到着時刻</h2>
            <input type="datetime-local" name="end_datetime" value=<?=date("Y-m-d\TH:i");?>>
          </div>
        </div>
        <hr>
        <div class="transportation">
          <h2>移動手段</h2>
          <select name='transportation'>
            <option value='car'>車</option>
            <option value='train'>電車</option>
            <option value='bus'>バス</option>
            <option value='walk'>徒歩</option>
            <option value='airplane'>飛行機</option>
            <option value='ferry'>フェリー</option>
          </select>
        </div>
        <input type="hidden" name="travel_id" value="<?= $travel_id ?>">
        <!--valueはjsで指定-->
        <input type="hidden" name="route_id" id="tab-transportation-route-number" value="" >
        <input type="hidden" name="is_transport" value="1" >
        <button type="submit" class="submit">移動の予定を追加</button>
      </form>

      <!-- タブ2の内容 -->
      <form id="modal-tab-schedule" class="tab-content" action="./registerItinerary.php" method="POST">
        <div class="addplace">
          <h2>場所を追加</h2>
          <input type="text" style="width:35%;" name="place">
        </div>
        <hr>
        <div class="addtime">
          <h2>時刻</h2>
          <input type="datetime-local" name="start_datetime" value=<?=date("Y-m-d\TH:i");?>>
        </div>
        <hr>
        <div class="addplans">
          <h2>予定</h2>
          <textarea name="detail" cols="25" rows="3"></textarea>
        </div>
        <input type="hidden" name="travel_id" value="<?= $travel_id ?>">
        <!--valueはjsで指定-->
        <input type="hidden" name="route_id" id="tab-itinerary-route-number" value="">
        <input type="hidden" name="is_transport" value="0" >
        <button class="submit" type="submit">予定を追加</button>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./scripts/header.js"></script>
</body>

</html>