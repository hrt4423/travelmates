<?php
// データベース接続設定
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "travelmates";

// MySQLiで接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続チェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// travelテーブルからtitleを取得するSQL
$sql = "SELECT title FROM travel";
$result = $conn->query($sql);

$titles = array();

if ($result->num_rows > 0) {
    // 取得したデータを配列に保存
    while($row = $result->fetch_assoc()) {
        $titles[] = $row['title'];
    }
}

// データをJSON形式で返す
echo json_encode($titles);

// 接続を閉じる
$conn->close();
?>
