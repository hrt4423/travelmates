<?php
include 'config.php'; // データベース接続

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"), true); // JSONデータを取得

        if (isset($data['route_id'], $data['departure'], $data['destination'])) {
            $route_id = $data['route_id'];
            $departure = $data['departure'];
            $departure_time = $data['departure_time'] ?? null;
            $via = $data['via'] ?? null;
            $destination = $data['destination'];
            $arrival_time = $data['arrival_time'] ?? null;
            $transportation = $data['transportation'] ?? null;
            $cost = $data['cost'] ?? 0;

            // データベースに予定を挿入
            $stmt = $pdo->prepare("INSERT INTO schedules (route_id, departure, departure_time, via, destination, arrival_time, transportation, cost) 
                VALUES (:route_id, :departure, :departure_time, :via, :destination, :arrival_time, :transportation, :cost)");
            $stmt->bindParam(':route_id', $route_id);
            $stmt->bindParam(':departure', $departure);
            $stmt->bindParam(':departure_time', $departure_time);
            $stmt->bindParam(':via', $via);
            $stmt->bindParam(':destination', $destination);
            $stmt->bindParam(':arrival_time', $arrival_time);
            $stmt->bindParam(':transportation', $transportation);
            $stmt->bindParam(':cost', $cost);
            $stmt->execute();

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '必須フィールドが不足しています']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => '無効なリクエストです']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
