<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メールアドレス変更</title>
    <link rel="stylesheet" href="../app/styles/changemail.css?<?php echo date('YmdHis'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/header.css" type="text/css">
</head>

<body>
    <header class="header d-flex justify-content-between align-items-center">
        <a href="index.html" class="nav-item">
            <img src="./assets/logo_green.png" alt="Site Logo" class="site-logo">
        </a>
        <nav class="nav">
            <div class="nav-item">
                <a href="#">
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

    <p>現在のメールアドレス：xxxx@xx.xx</p>
    <div class="newaddres">
        新しいメールアドレス：<input type="text">
    </div>
    <div class="checkaddres">
        <p>（確認用）</p>
        新しいメールアドレス：<input type="text">
    </div>
    <div align="center" class="button">
        <button class="button_maru" onclick="back()">戻る</button>
        <button class="button_maru" onclick="complete()">保存</button>
    </div>
    <script src="./scripts/changereg.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./scripts/header.js"></script>
</body>

</html>