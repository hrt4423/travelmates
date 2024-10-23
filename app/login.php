<?php
    //セッション開始
    session_start();

    // データベース接続
    require_once 'db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        //入力値のバリデーションチェック
        if(empty($email) || empty($password)) {
            $error = "メールアドレスとパスワードを入力してください。";
            $_SESSION['error'] = $error;
            header("Location: ./user_login.php");
            exit;
        }

        //SQLインジェクション対策:プリペアードステートメント
        $stmt = $pdo->prepare("SELECT user_id, password FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在し、パスワードが正しいか確認
        if ($user && password_verify($password, $user['password'])) {
            // セッションIDの再生成
            session_regenerate_id(true);

            // セッションにユーザーIDを保存
            $_SESSION['user_id'] = $user['user_id'];

            // ログイン後のページへリダイレクト
            header('Location: ./home.php');
            exit;
        } else {
            $error = "メールアドレスまたは、パスワードが間違っています。";
            $_SESSION['error'] = $error;
            header("Location: ./user_login.php");
            exit();
        }
    }

?>
