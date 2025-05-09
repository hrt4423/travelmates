
<?php
$host = 'localhost';
$dbname = 'travelmates'; // データベース名
$username = 'root'; // データベースのユーザー名
$password = 'root'; // データベースのパスワード

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("接続失敗: " . $e->getMessage());
}
?>
