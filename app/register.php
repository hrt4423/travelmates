<?php
    // データベース接続
    require_once 'db.php';

    session_start();


    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // バリデーションチェック
        // 必須項目チェック
        if(empty($email)) {
            $error = "メールアドレスを入力してください。";
            $_SESSION['error'] = $error;
            header("Location: ./user_register.php");
            exit;
        }else if(empty($username)) {
            $error = "ユーザー名を入力してください。";
            $_SESSION['error'] = $error;
            header("Location: ./user_register.php");
            exit;
        }else if(empty($password)) {
            $error = "パスワードを入力してください。";
            $_SESSION['error'] = $error;
            header("Location: ./user_register.php");
            exit;
        }

        // メールアドレス形式チェック
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "有効なメールアドレスを入力してください。";
            $_SESSION['error'] = $error;
            header("Location: ./user_register.php");
            exit;
        }

        // 文字数、大文字小文字混在、数字、特殊文字チェック
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (!preg_match($pattern, $password)) {
            $error = "パスワードは8文字以上かつ、大文字、小文字、数字、および特殊文字をそれぞれ1つ以上含める必要があります。";
            $_SESSION['error'] = $error;
            header("Location: ./user_register.php");
            exit;
        }

        // パスワードハッシュ化
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $error = "このメールアドレスはすでに使用されています。";
                $_SESSION['error'] = $error;
                header("Location: ./user_register.php");
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO user (name, password, email) VALUES (:name, :password, :email)");
            $stmt->bindParam(':name',$username);
            $stmt->bindParam(':password',$hashed_password);
            $stmt->bindParam(':email',$email);
            $stmt->execute();

            header("Location: ./login.html");

        } catch (PDOException $e) {
            echo "エラー: " . $e->getMessage();
            die();
        }
    }else{
        // POSTでない場合はsignup.phpにリダイレクト
        header("Location: ./user_register.php");
        exit;
    }
?>