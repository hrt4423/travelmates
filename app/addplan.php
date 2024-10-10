<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予定追加</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../app/styles/addplan.css?<?php echo date('YmdHis'); ?>">
</head>

<body>
    <!-- セッションから旅行タイトルを取得、表示 -->
    <?php
    session_start();
    echo '<div id="title">';
    if (isset($_SESSION['title'])) {
        $title = $_SESSION['title'];
        echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    } else {
        echo 'タイトルが設定されていません。';
    }
    echo '</div>';
    ?>

    <!-- ルート追加ボタン -->
    <button id="addRouteButton">ルートを追加する</button>

    <!-- 追加されたルートを表示するコンテナ -->
    <div id="routes" class="container">
        <!-- 最初のルートが表示されるエリア -->
    </div>
<!-- モーダルのHTML -->
<div id="modal" class="hidden">
    <div id="modal-content">
        <span id="closeModal">&times;</span>
        <!-- モーダル内のタブUI -->
        <div class="tab-container">
            <div class="tab active" data-target="modal-tab1">移動</div>
            <div class="tab" data-target="modal-tab2">予定</div>
        </div>

        <!-- タブ1の内容 (移動のデータ) -->
        <form id = "scheduleForm" action="addplan_db.php" method="POST">
            <input type="hidden" name="route_number" id="routeNumber">

            <div id="modal-tab1" class="tab-content active">
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
                        <input type="text" style="width:35%;" name="start_hour"> :
                        <input type="text" style="width:35%;" name="start_minute">
                    </div>
                </div>
                <div class="arrive-time-container">
                    <div class="arrive-place">
                        <h2>目的地</h2>
                        <input type="text" style="width:40%;" name="end">
                    </div>
                    <div class="arrive-time">
                        <h2>到着時刻</h2>
                        <input type="text" style="width:35%;" name="end_hour"> :
                        <input type="text" style="width:35%;" name="end_minute">
                    </div>
                </div>
                <hr>
                <div class="transportation">
                    <h2>移動手段</h2>
                    <select name="vehicle" required>
                        <option value="" disabled selected>選択してください</option>
                        <option value="1">車</option>
                        <option value="2">飛行機</option>
                        <option value="3">フェリー</option>
                    </select>
                </div>
                <!-- フォームの送信ボタン -->
                <button class="submit" type="submit">スケジュールを追加</button>
            </div>
        </form>

        <!-- タブ2の内容 (予定のデータ) -->
        <form id="scheduleForm" action="addplan_db.php" method="POST">
        <input type="hidden" name="route_number" id="routeNumber">
            <div id="modal-tab2" class="tab-content">
                <div class="addplace">
                    <h2>場所を追加</h2>
                    <input type="text" style="width:35%;" name="place">
                </div>
                <div class="arrive-time-container">
                    <div class="arrive-place">
                        <h2>目的地</h2>
                        <input type="text" style="width:40%;" name="plan_end">
                    </div>
                    <div class="arrive-time">
                        <h2>到着時刻</h2>
                        <input type="text" style="width:35%;" name="plan_hour"> :
                        <input type="text" style="width:35%;" name="plan_minute">
                    </div>
                </div>
                <!-- フォームの送信ボタン -->
                <button class="submit" type="submit">スケジュールを追加</button>
            </div>
        </form>
    </div>
</div>




    <script src="../app/scripts/addplan.js"></script>
</body>

</html>
