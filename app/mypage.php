<?php
// セッション開始
session_start();
$user_id = $_SESSION['user_id'];

// データベース接続
require_once('dao/Connection.php');
$connection = new Connection();
$pdo = $connection->getPdo();

try {
    // データベースからユーザー情報(名前、アイコン)と予定一覧を取得
    $stmt = $pdo->prepare("
        SELECT 
            u.email,
            u.name,
            u.icon_path,
            t.travel_id,
            t.title,
            t.image_path,
            t.start_datetime,
            t.end_datetime
        FROM 
            user u
        LEFT JOIN 
            travel t
        ON 
            u.user_id = t.management_id
        WHERE 
            u.user_id = :user_id
    ");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // ユーザー情報と旅行情報を取得
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        // ユーザー情報を取得
        $user_info = [
            'email' => $result[0]['email'],
            'name' => $result[0]['name'],
            'icon_path' => $result[0]['icon_path']
        ];

        // 旅行情報を取得
        $travel_list = [];
        foreach ($result as $row) {
            if ($row['travel_id'] !== null) { // 予定が存在する場合のみ追加
                $travel_list[] = [
                    'travel_id' => $row['travel_id'],
                    'title' => $row['title'],
                    'image_path' => $row['image_path'],
                    'start_datetime' => $row['start_datetime'],
                    'end_datetime' => $row['end_datetime']
                ];
            }
        }

        // 結果を出力（例として配列をJSON形式で表示）
    } else {
        echo json_encode(['message' => 'ユーザー情報が見つかりませんでした。']);
    }
} catch (Exception $e) {
    echo "エラーが出ました。";
}
?>
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
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>マイページ</title>
        <link rel="stylesheet" href="./assets/css/style.css">
    </head>
    <body>
        <div class="section" id="user-name">
            <p>
                <img src="./assets/image/mypage_icon.svg" alt="User Profile" class="profile-icon">
                <span id="username"><?= htmlspecialchars($user_info['name'] ?? '未設定') ?></span>
            </p>
        </div>
        <div class="section" id="user-mail">
            <div>メールアドレス: <span id="email"><?= htmlspecialchars($user_info['email'] ?? '未設定') ?></span></div>
        </div>
        <div class="section" id="schedule">
            <div><a href="./my_travel.php">予定一覧を見る</a></div>
        </div>
        <div class="section" id="edit-info">
            <div><a href="./change_reg.php">登録内容変更</a></div>
        </div>
        <div align="center" class="button">
            <a href="./logout.php"><button class="button_maru">ログアウト</button></a>
        </div>
    </body>
    </html>
    <script src="./scripts/mypage.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./scripts/header.js"></script>
</body>
</html>
