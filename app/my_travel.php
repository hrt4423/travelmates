<?php
// セッション開始
session_start();
$user_id = $_SESSION['user_id'];

// データベース接続
require_once('dao/Connection.php');
$connection = new Connection();
$pdo = $connection->getPdo();

try {
    // ユーザーの旅行情報を取得
    $stmt = $pdo->prepare("
        SELECT 
            travel_id, title, image_path, start_datetime, end_datetime
        FROM 
            travel
        WHERE 
            management_id = :user_id
    ");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $travel_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "エラーが出ました。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>旅行一覧</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/header.css">
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
    <h1>旅行一覧</h1>
    <ul>
        <?php if (!empty($travel_list)): ?>
            <?php foreach ($travel_list as $travel): ?>
                <li>
                    <img src="<?= htmlspecialchars($travel['image_path']) ?>" alt="Travel Image" style="width:100px;height:auto;">
                    <div>
                        <strong><?= htmlspecialchars($travel['title']) ?></strong><br>
                        期間: <?= htmlspecialchars($travel['start_datetime']) ?> ～ <?= htmlspecialchars($travel['end_datetime']) ?>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>旅行の予定はありません。</li>
        <?php endif; ?>
    </ul>
    <a href="./mypage.php">マイページに戻る</a>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./scripts/header.js"></script>
</body>
</html>

