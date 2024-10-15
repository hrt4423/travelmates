<?php
include 'post_config.php'; // データベース接続

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"), true); // JSONデータを取得

        if (isset($data['route_name'])) {
            $route_name = $data['route_name'];

            // データベースにルートを挿入
            $stmt = $pdo->prepare("INSERT INTO routes (route_name) VALUES (:route_name)");
            $stmt->bindParam(':route_name', $route_name);
            $stmt->execute();

            // 挿入されたルートのIDを取得
            $route_id = $pdo->lastInsertId();

            echo json_encode(['status' => 'success', 'route_id' => $route_id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ルート名が提供されていません']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => '無効なリクエストです']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
