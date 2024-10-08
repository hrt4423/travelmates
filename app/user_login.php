<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/user_login.css">
    <title>login</title>
</head>
<body>
    <div class="container-fluid">
        <div class="text-center">
            <img src="./assets/logo_green.png" alt="ロゴ" class="rogoinner m-lg-0">
        </div>
        <h1 class="text-white text-center m-lg-0">ログイン</h1>

        <form action="./login.php" method="POST">
            <div class="d-flex justify-content-center my-4">
                <div class="w-100">
                    <div class="mb-3">
                        <div class="cp_iptxt">
                            <input class="ef" type="text" name="email">
                            <label>Mail</label>
                            <span class="focus_line"></span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="cp_iptxt">
                            <input class="ef" type="password" name="pass">
                            <label>Pass</label>
                            <span class="focus_line"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-message text-danger text-center m-lg-1">
                <?php 
                    // エラーメッセージがセッションに保存されていれば表示する
                    if (isset($_SESSION['error'])) {
                        echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']); // セッションからエラーメッセージを削除
                    }
                ?>
            </div>

            <div>
                <div class="row">
                    <div class="col-lg-6 col-6 d-flex align-items-center justify-content-center">
                        <a href="./user_register.php">
                            <button type="button" class="btn btn-light m-lg-5" onclick="history.back()">新規登録</button>
                        </a>
                    </div>
                    <div class="col-lg-6 col-6 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-light m-lg-5">ログイン</button>
                    </div>
                </div>
            </div>         
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
