// ルート追加/削除/モーダル操作のイベントリスナー
document.getElementById('prevBtn').addEventListener('click', function() {
    document.getElementById('routesContainer').scrollBy({
        left: -300,
        behavior: 'smooth'
    });
});

document.getElementById('nextBtn').addEventListener('click', function() {
    document.getElementById('routesContainer').scrollBy({
        left: 300,
        behavior: 'smooth'
    });
});

// ルート追加モーダルの表示/非表示 (予定用)
const routeModal = document.getElementById('routeModal');
const closeRouteModalButton = document.getElementById('closeRouteModalButton');

// ルート追加ボタンが押された時、新しいルートをデータベースに登録し、作成する処理
const addRouteButton = document.getElementById('addRouteButton');
addRouteButton.onclick = function() {
    const routeName = `ルート ${document.querySelectorAll('.route').length + 1}`;

    // AJAXでルートをデータベースに登録
    fetch('add_route.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ route_name: routeName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // データベースに追加されたらフロントにルートを表示
            const newRouteContainer = document.createElement('div');
            newRouteContainer.className = 'route';
            newRouteContainer.innerHTML = `
                <header>
                    <h2>${routeName}</h2>
                    <button class="delete">削除</button>
                </header>
                <ul class="schedule"></ul>
                <button class="add-schedule">+ 予定を追加</button>
            `;
            
            // ルートの「予定を追加」ボタンが押されたとき、モーダルを表示
            newRouteContainer.querySelector('.add-schedule').onclick = function() {
                routeModal.style.display = 'flex';
                selectedRoute = newRouteContainer.querySelector('ul.schedule'); // 予定を追加する対象ルートを設定
                selectedRouteId = data.route_id; // 追加されたルートのIDを保存
            };

            // ルートを削除する処理
            newRouteContainer.querySelector('.delete').onclick = function() {
                newRouteContainer.remove();
            };

            // 新しいルートを表示
            document.getElementById('routesContainer').appendChild(newRouteContainer);
        }
    });
};

// モーダルの閉じるボタン
closeRouteModalButton.onclick = function() {
    routeModal.style.display = "none";
};

// モーダル外クリックで閉じる
window.onclick = function(event) {
    if (event.target === routeModal) {
        routeModal.style.display = "none";
    }
};

// 予定を追加するための対象ルートとID
let selectedRoute = null;
let selectedRouteId = null;

// フォーム送信イベント：モーダルで予定を追加し、データベースに登録
document.getElementById('addRouteForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const departure = formData.get('departure');
    const departureTime = formData.get('departure-time');
    const via = formData.get('via');
    const destination = formData.get('destination');
    const arrivalTime = formData.get('arrival-time');
    const transportation = formData.get('transportation');
    const cost = formData.get('cost');

    // AJAXで予定をデータベースに登録
    fetch('add_schedule.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            route_id: selectedRouteId,
            departure: departure,
            departure_time: departureTime,
            via: via,
            destination: destination,
            arrival_time: arrivalTime,
            transportation: transportation,
            cost: cost
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // データベースに追加されたらフロントに予定を表示
            const scheduleItem = document.createElement('li');
            scheduleItem.innerHTML = `
                <span>${departure}</span> <span>${departureTime} 発</span>
                ${via ? `<span>経由: ${via}</span>` : ''}
                <span>${destination}</span> <span>${arrivalTime} 着</span>
            `;
            selectedRoute.appendChild(scheduleItem);
        }
    });

    // モーダルを閉じる
    routeModal.style.display = 'none';
    event.target.reset();
});
