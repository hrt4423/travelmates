<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容変更</title>
    <link rel="stylesheet" href="./styles/changereg.css">
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

    <div class="section" id="user-name">
        <p>
            <img src="./assets/image/mypage_icon.svg" alt="User Profile" class="profile-icon">
            <span id="username">プロフィール画像</span>
        </p>
    </div>
    <div class="section" id="name">
        <div>なまえ </div><span id="name">ハム太郎</span>
    </div>
    <div class="section" id="user-mail">
        <div>メールアドレス<span id="email">user@example.com</span></div>
    </div>
    <div class="section" id="edit-info">
        <div>パスワード</div>
    </div>
    <div align="center" class="button">
        <button class="button_maru" onclick="back()">戻る</button>　　　　　　　　　　　　　
        <button class="button_maru" onclick="complete()">完了</button>
    </div>
    <script src="./scripts/changereg.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./scripts/header.js"></script>
</body>

</html>