<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規作成</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/Styles.css">


</head>
<body>
    <header class="header d-flex justify-content-between align-items-center">
        <a href="index.html" class="nav-item">
            <img src="./assets/logo_green.png" alt="Site Logo" class="site-logo">
        </a>
        <nav class="nav">
            <div class="nav-item">
                <a href="#">
                    <img src="./assets/image/user_icon.svg" alt="User Icon" class="icon">
                </a>
            </div>
            <div class="nav-item">
                <a href="#">
                    <img src="./assets/image/notification.svg" alt="Notification Icon" class="icon">
                </a>
            </div>
        </nav>
    </header>
    <main>
        <h2>タイトル</h2>
        <input type="text" name="name" placeholder="テキストを入力">
        <h2>写真</h2>
        <div class="image-preview">
            <img id="image-preview" src="" alt="画像プレビュー">
        </div>
        <input type="file" id="file-input" accept="image/*">
    </main>
    <footer>
        <div class="button-container">
            <button class="button" type="button">戻る</button>
            <button class="button next-button" type="button">次に進む</button>
        </div>
    </footer>

    <script>
        document.getElementById('file-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imgElement = document.getElementById('image-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgElement.src = e.target.result;
                    imgElement.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imgElement.style.display = 'none';
            }
        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./scripts/home.js"></script>
</body>
</html>