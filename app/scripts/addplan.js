// モーダルとボタンの要素を取得
var modal = document.getElementById('modal');
var span = document.getElementById('closeModal');
let routeCount = 1; // ルートのカウントを管理

// ルート追加ボタンのクリック時に新しいルートを追加する
document.getElementById('addRouteButton').addEventListener('click', function() {
    // ルートのHTMLを生成してコンテナに追加
    var newRoute = `
        <div class="route" data-route-number="${routeCount}">
            <p>ルート${routeCount}</p>
            <input type="hidden" name="route_number" value="${routeCount}">
            <button class="openModalButton">予定を追加する</button>
        </div>`;
    
    document.getElementById('routes').insertAdjacentHTML('beforeend', newRoute);

    // 追加されたルートの「予定を追加する」ボタンにイベントリスナーを追加
    var lastOpenModalButton = document.querySelector('#routes .route:last-child .openModalButton');
    lastOpenModalButton.addEventListener('click', function() {
        modal.className = 'show';

        // クリックされたルートの番号をフォームにセット
        var routeNumber = this.closest('.route').getAttribute('data-route-number');
        document.getElementById('routeNumber').value = routeNumber;
    });

    routeCount++; // ルート番号を更新
});

// モーダルを閉じる機能
span.onclick = function() {
    modal.className = 'hidden'; // モーダルを非表示
};

// モーダル外をクリックしたときにモーダルを閉じる
window.onclick = function(event) {
    if (event.target === modal) {
        modal.className = 'hidden';
    }
};

// タブ切り替え機能を追加
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // アクティブなタブとタブコンテンツをリセット
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));

        // クリックされたタブをアクティブにする
        this.classList.add('active');

        // 対応するタブコンテンツを表示
        const targetId = this.getAttribute('data-target');
        document.getElementById(targetId).classList.add('active');
    });
});
