<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Planner</title>
    <link rel="stylesheet" href="post_styles.css">
</head>
<body>
    <header class="main-header">
        <!-- ヘッダーコンテンツ -->
    </header>
    <div class="container">
        <nav>
            <a href="#" class="back">ホーム</a>
        </nav>
        <div class="trip-info">
            <h1>大分旅行</h1>
            <button class="add-route" id="addRouteButton">+ルートを追加</button>
            <p>2022/02/21-2022/02/24</p>
        </div>
        <main>
            <div class="carousel-container">
                <button class="carousel-button left" id="prevBtn">＜</button>
                <section class="routes" id="routesContainer">
                    <!-- ルートカード -->
                </section>
                <button class="carousel-button right" id="nextBtn">＞</button>
            </div>
            <aside class="members">
                <h3>メンバー</h3>
                <ul>
                    <li>平田</li>
                    <li>岸川</li>
                    <li>山中</li>
                    <li>前田</li>
                    <li>飯干</li>
                    <li>塚原</li>
                    <li>高原</li>
                    <li>川口</li>
                </ul>
                <button class="add-member" id="addMemberButton">+メンバーを追加</button>
            </aside>
        </main>
    </div>

    <!-- ルート追加モーダル -->
    <!-- ルート追加モーダル (修正不要ですが、フォームの名称を一般化) -->
<div id="routeModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeRouteModalButton">&times;</span>
        <h2>予定を追加</h2>
        <form id="addRouteForm"> <!-- 名前を汎用化して予定にも使えるようにする -->
            <label for="type">移動or予定</label>
            <select id="type" name="type">
                <option value="移動">移動</option>
                <option value="予定">予定</option>
            </select>
            <label for="cost">料金</label>
            <input type="number" id="cost" name="cost" required>
            <label for="departure">出発地</label>
            <input type="text" id="departure" name="departure" required>
            <label for="departure-time">出発時刻</label>
            <input type="time" id="departure-time" name="departure-time" required>
            <label for="via">経由地</label>
            <input type="text" id="via" name="via">
            <label for="destination">目的地</label>
            <input type="text" id="destination" name="destination" required>
            <label for="arrival-time">到着時刻</label>
            <input type="time" id="arrival-time" name="arrival-time" required>
            <label for="transportation">移動手段</label>
            <select id="transportation" name="transportation">
                <option value="車">車</option>
                <option value="飛行機">飛行機</option>
                <option value="電車">電車</option>
            </select>
            <button type="submit">追加</button>
        </form>
    </div>
</div>


    <script src="post_scripts.js"></script>
</body>
</html>
