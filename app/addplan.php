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
    <div class = "travel_name"><?php session_start(); $travel_name = $_SESSION['travel_name']; echo $travel_name;?></div>
    <div class="container">
    <div id="routes" class="row">
    <?php

    try {
        $travel_id = $_SESSION['travel_id'];
        $pdo = new PDO('mysql:host=localhost;dbname=travelmates;charset=utf8', 'root', 'root');
        $stmt = $pdo->prepare('SELECT * FROM event WHERE travel_id = ? ORDER BY route_id ASC');
        $stmt->execute([$travel_id]);
        $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($routes) {
            $lastRouteNumber = 0;
            $route_set = 999;
            $sumRouteCharge = 0;

            foreach ($routes as $route) {
                $event_id = $route['event_id'];
                $route_db = $route['route_id'];
                $place = $route['place'];
                $event_detail = $route['event_detail'];
                $start_datetime = $route['start_datetime'];
                $end_datetime = $route['end_datetime'];
                $form_check = isset($_POST['is_transport']) ? $_POST['is_transport'] : 0;
                $start = $route['place'];
                $end = $route['event_detail'];
                $charge = $route['charge'];
                // 日時を「時:分」形式に変換
                $start_datetime = (new DateTime($start_datetime))->format('H:i');
                $end_datetime = (new DateTime($end_datetime))->format('H:i');

                // 新しいルートの場合は新しい<div>を作成
                if ($route_db != $route_set) {
                    if ($route_set != 999) {
                        // 前のルートを閉じるとき、最後にボタンを追加して閉じる
                        echo "<button id='{$lastRouteNumber}' class='openModalButton'>予定を追加する</button>";
                        echo "<div class='sumRouteCharge'>合計金額: {$sumRouteCharge}円</div>";
                        echo "</div>"; // ルート終了の閉じタグ
                        $sumRouteCharge = 0;
                    }

                    $lastRouteNumber++;
                    echo "<div class='col-12 route' data-route-number='{$lastRouteNumber}'>
                            <div class='lastRouteNumber'><p>ルート{$lastRouteNumber}</p></div>";
                }
                $sumRouteCharge += $charge;
                // データの内容に応じて表示する内容を切り替える
                if ($form_check == 1) {
                    echo "
                        <div class='start'>{$start}</div>
                        <div class='button'><button name='button'>編集</button></div>
                        <div class='start_datetime'>{$start_datetime}発</div>
                        <div class='end'>{$end}</div>
                        <div class='end_datetime'>{$end_datetime}着</div>
                        <div class='editButton'><button class='editButton' data-event-id='{$event_id}' data-route-number='{$lastRouteNumber}'>編集</button></div>"
                        ;
                } else {
                    echo "
                        <div class='place'>{$place}</div>
                        <div class='start_datetime'>{$start_datetime}着</div>
                        <div class='editButton'><button class='editButton' data-event-id='{$event_id}' data-route-number='{$lastRouteNumber}'>編集</button></div>";
                }

                // 現在のルート番号を次の比較用に保存
                $route_set = $route_db;
            }

            // 最後のルートの閉じタグとボタンを追加
            echo "<button id='{$lastRouteNumber}' class='openModalButton'>予定を追加する</button>
                  <div class='sumRouteCharge'>合計金額: {$sumRouteCharge}円</div>
            ";
            echo "</div>"; // 最後のルートを閉じる
        } else {
            echo "<p>登録されているルートはありません。</p>";
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . $e->getMessage();
    }
    ?>
    <script>
        // PHPの変数をJavaScriptに渡す
        window.lastRouteNumber = <?php echo $lastRouteNumber; ?>;
    </script>
</div>


        <button id="addRouteButton" class="btn btn-primary mt-3">新しいルートを追加する</button>

        <!-- モーダル -->
        <div id="modal" class="hidden">
            <div id="modal-content">
                <span id="closeModal">&times;</span>

                <div class="tab-container">
                    <div class="tab active" data-target="modal-tab1">移動</div>
                    <div class="tab" data-target="modal-tab2">予定</div>
                </div>

                <!-- タブ1：移動 -->
                <form id="scheduleForm1" action="addplan_db.php" method="POST">
                    <!-- モーダルのフォーム内 -->
                    <input type="hidden" name="event_id1" value="">
                    <input type="hidden" name="last_route_number" value="<?php echo $lastRouteNumber; ?>">
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
                <form id="scheduleForm2" action="addplan_db.php" method="POST">
                    <!-- モーダルのフォーム内 -->
                    <input type="hidden" name="event_id2" value="">
                    <input type="hidden" name="last_route_number" value="<?php echo $lastRouteNumber; ?>">
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

    <script src="../app/scripts/addplan.js"></script>
</body>
</html>