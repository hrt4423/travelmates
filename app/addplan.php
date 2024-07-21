<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予定追加</title>
    <link rel="stylesheet" href="../app/styles/addplan.css?<?php echo date('YmdHis'); ?>">
</head>

<body>
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
            <div id="modal-tab1" class="tab-content active">
                <h2>料金</h2><br>
                <input type="text" placeholder="" style="width:35%;" name="budget">円
            </div>
            <div id="modal-tab2" class="tab-content">
                <h2></h2>
                <p></p>
            </div>
        </div>
    </div>

    <script src="../app/scripts/addplan.js"></script>
</body>

</html>