<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

// フォームから送信されたデータをセッションに保存
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['title'] = $_POST['title'];  // タイトルをセッションに保存

    // 画像がアップロードされた場合の処理
    // if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    //     $upload_dir = './assets/travel-image/';  // 画像を保存するディレクトリ
    //     $upload_file = $upload_dir . basename($_FILES['image']['name']);  // 保存先ファイルパス
        
    //     // ファイルを指定の場所に移動
    //     if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
    //         // 画像パスをセッションに保存
    //         $_SESSION['image_path'] = $upload_file;
    //     } else {
    //         echo "画像のアップロードに失敗しました。";
    //         $_SESSION['image_path'] = './assets/travel-image/default.png';  // アップロード失敗時のデフォルト画像
    //     }
    // } else {
    //     // 画像がアップロードされていない場合やエラーがあった場合、デフォルト画像を使用
    //     $_SESSION['image_path'] = './assets/travel-image/default.png';
    // }

    // セッションからデータ取得
    $title = $_SESSION['title'];
    $image_path = $_SESSION['image_path'];
    $management_id = $_SESSION['user_id'];  // ユーザーID（管理ID）としてセッションのuser_idを使用
    $start_datetime = 0;  // 開始日時（本来は適切な値を設定する必要があります）
    $end_datetime = 0;    // 終了日時（本来は適切な値を設定する必要があります）

    require_once('dao/Connection.php');
    $connection = new Connection();
    $pdo = $connection->getPdo();

    try {
        // データベースに接続
        // $pdo = new PDO($dsn, $username, $password);

        // エラーモードを例外モードに設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQLクエリを準備
        $stmt = $pdo->prepare('INSERT INTO travel (title, image_path, management_id, start_datetime, end_datetime) VALUES (:title, :image_path, :management_id, :start_datetime, :end_datetime)');

        // 値をバインドしてSQLを実行
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);
        $stmt->bindValue(':management_id', $management_id, PDO::PARAM_INT);
        $stmt->bindValue(':start_datetime', $start_datetime, PDO::PARAM_STR);
        $stmt->bindValue(':end_datetime', $end_datetime, PDO::PARAM_STR);

        // SQLを実行してデータを挿入
        $stmt->execute();

        // 挿入されたtravel_idを取得
        $travel_id = $pdo->lastInsertId();

        // 挿入されたtravel_idをセッションに保存
        $_SESSION['travel_id'] = $travel_id;
        $_SESSION['travel_name'] = $title;

        //memberテーブルに追加　作業者：平田------------------------
        require_once('dao/member.php');
        $member = new Member();
        $member->registerMember($travel_id, $management_id);
        //--------------------------------------------------------

        // 正常に追加されたら次のページにリダイレクト
        header("Location: travel_plan.php?travel_id=$travel_id");
        exit();
    } catch (PDOException $e) {
        // エラーが発生した場合、エラーメッセージを表示
        echo 'データベースエラー: ' . $e->getMessage();
    }
}
?>
