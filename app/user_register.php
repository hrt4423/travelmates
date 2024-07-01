<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>新規登録</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #62B073;
            color: #fff;
        }
        
        /* ロゴ画像のスタイル */
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 75px; /* 画像の幅を調整 */
            height: auto;
        }

        /* タイトルからボタンまでのスタイル */
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            margin-top: 100px;
            padding: 20px;
        }

        /* 「新規登録」のスタイル */
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* テキストボックスのスタイル */
        .form-control {
            background-color: #62B073;
            color: #fff;
            border: none;
            border-bottom: 2px solid #fff;
            border-radius: 0;
        }

        /* プレースホルダーのスタイル */
        .form-control::placeholder {
            color: #fff;
        }

        /* 入力時のスタイル */
        .form-control:focus {
            background-color: #62B073;
            color: #fff;
            border-color: #fff;
            box-shadow: none;
            outline: none;
        }

        /* 入力後のスタイル */
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus,
        .form-control:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0px 1000px #62B073 inset;
            -webkit-text-fill-color: #fff;
            border-bottom: 2px solid #fff;
            transition: background-color 5000s ease-in-out 0s;
        }

        
    </style>
</head>
<body>
    <img src="assets/logo.png" alt="Logo" class="logo">
    <div class="container">
        <div class="register-container">
            <h2>新規登録</h2>
            <form>
                <!-- メールアドレスのテキストボックス -->
                <div class="form-group">
                    <input type="email" class="form-control" id="email" placeholder="Mail">
                </div>
                <!-- ユーザーネームのテキストボックス -->
                <div class="form-group">
                    <input type="text" class="form-control" id="username" placeholder="Name">
                </div>
                <!-- パスワードのテキストボックス -->
                <div class="form-group">
                    <input type="password" class="form-control" id="password" placeholder="Pass">
                </div>

                <!-- エラーメッセージの表示エリア -->
                <div class="error-area">
                </div>

                <!-- ボタンエリア -->
                <div class="form-row mt-4">
                    <!-- 戻るボタン -->
                    <div class="col">
                        <button type="button" onclick="history.back()" class="btn btn-secondary btn-block">戻る</button>
                    </div>
                    <!-- ボタン間の空白部分 -->
                    <div class="col">
                    </div>
                    <!-- 新規登録ボタン -->
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">新規登録</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
