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

    <!-- ボタン -->
    <button id="openModal">予定を追加する</button>

    <!-- モーダルウィンドウ -->
    <div id="modal" class="hidden">
        <div id="modal-content">
            <span id="closeModal">&times;</span>
            <!-- モーダル内のタブUI -->
            <div class="tab-container">
                <div class="tab active" data-target="modal-tab1">移動</div>
                <div class="tab" data-target="modal-tab2">予定</div>
            </div>
            <!-- タブ１の内容 -->
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
            <div id="modal-tab2" class="tab-content">
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

    <script src="../app/scripts/addplan.js"></script>
</body>

</html>