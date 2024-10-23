<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>新規登録</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/user_register.css">
</head>
<body>
    <img src="assets/logo_green.png" alt="Logo" class="logo">
    <div class="container">
        <div class="register-container">
            <h2>新規登録</h2>
            <form action="./register.php" method="POST">
                <!-- メールアドレスのテキストボックス -->
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Mail">
                </div>
                <!-- ユーザーネームのテキストボックス -->
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Name">
                </div>
                <!-- パスワードのテキストボックス -->
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Pass">
                </div>

                <!-- エラーメッセージの表示エリア -->
                <div class="error-area text-center">
                    <?php 
                        // エラーメッセージがセッションに保存されていれば表示する
                        if (isset($_SESSION['error'])) {
                            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
                            unset($_SESSION['error']); // セッションからエラーメッセージを削除
                        }
                    ?>
                </div>

                <!-- ボタンエリア -->
                <div class="form-row">
                    <!-- 戻るボタン -->
                    <div class="col">
                        <button type="button" onclick="history.back()" class="btn btn-secondary btn-block">戻る</button>
                    </div>
                    <!-- ボタン間の空白部分 -->
                    <div class="col">
                    </div>
                    <!-- 新規登録ボタン -->
                    <div class="col">
                        <button type="submit" class="btn btn-light btn-block">新規登録</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="./user_login.php">ログインする</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
