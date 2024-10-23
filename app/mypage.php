<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <link rel="stylesheet" href="./styles/mypage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/header.css" type="text/css">
</head>
<body>
    <header class="header d-flex justify-content-between align-items-center">
        <a href="./home.php" class="nav-item">
            <img src="./assets/logo.png" alt="Site Logo" class="site-logo">
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
            <span id="username">なまえ</span>
        </p>
    </div>
    <div class="section" id="user-mail">
        <div>メールアドレス: <span id="email">user@example.com</span></div>
    </div>
    <div class="section" id="schedule">
        <div>予定一覧</div>
    </div>
    <div class="section" id="edit-info">
        <div><a href="./change_reg.php">登録内容変更</a></div>
    </div>
    <div align="center" class="button">
        <button class="button_maru"><a href="./logout.php">ログアウト</a></button>
    </div>
    <script src="./scripts/mypage.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./scripts/header.js"></script>
</body>
</html>
