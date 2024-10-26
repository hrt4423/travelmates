// モーダルとボタンの要素を取得
var modal = document.getElementById('modal');
var span = document.getElementById('closeModal');

// モーダルを開くボタンにイベントリスナーを追加
document.querySelectorAll('.openModalButton').forEach(button => {
    button.addEventListener('click', function() {
        const routeNumber = this.closest('.route').getAttribute('data-route-number');
        document.getElementById('routeNumber').value = routeNumber;

        // モーダルを表示
        modal.classList.remove('hidden'); 
        
        // アクティブタブを 'modal-tab1' に設定
        const activeTab = 'modal-tab1'; 
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
        
        document.getElementById(activeTab).classList.add('active');
        document.querySelector(`[data-target="${activeTab}"]`).classList.add('active');
        
        // ルート番号を入力
        document.getElementById('routeNumberInput1').value = routeNumber;
        document.getElementById('routeNumberInput2').value = routeNumber; // タブ1がアクティブの場合
    });
});

// モーダルを閉じる機能
span.onclick = function() {
    modal.classList.add('hidden'); // モーダルを非表示
};

// モーダル外をクリックしたときにモーダルを閉じる
window.onclick = function(event) {
    if (event.target === modal) {
        modal.classList.add('hidden');
    }
};

// タブの切り替えイベントを設定
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function () {
        // すべてのタブとタブコンテンツから 'active' クラスを削除
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));

        // クリックされたタブと対応するタブコンテンツに 'active' クラスを追加
        this.classList.add('active');
        const targetId = this.getAttribute('data-target');
        document.getElementById(targetId).classList.add('active');

        // セッションストレージに現在のタブ情報を保存
        sessionStorage.setItem('activeTab', targetId);
    });
});

// DOMContentLoadedの処理
document.addEventListener('DOMContentLoaded', () => {
    const routesContainer = document.getElementById('routes');
    
    // ルートを追加する関数
    const addRoute = (routeNum) => {
        const newRoute = document.createElement('div');
        newRoute.className = 'col-12 route';
        newRoute.dataset.routeNumber = routeNum;

        newRoute.innerHTML = `
            <p>ルート${routeNum}</p>
            <button class='openModalButton'>予定を追加する</button>`;
        
        routesContainer.appendChild(newRoute);
    };

    // 「ルートを追加」ボタンのクリック処理
    const addRouteButton = document.getElementById('addRouteButton');
    let routeCount = window.lastRouteNumber || 0;

    addRouteButton.onclick = () => {
        routeCount += 1;
        addRoute(routeCount);
    };

    // ルートコンテナのクリックイベント（モーダルを開く処理）
    routesContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('openModalButton')) {
            const routeNumber = event.target.closest('.route').dataset.routeNumber;

            // アクティブタブを 'modal-tab1' に設定
            const activeTab = 'modal-tab1'; 

            // アクティブタブによって隠しフィールドを選択
            document.getElementById('routeNumberInput1').value = routeNumber; // タブ1がアクティブの場合
            document.getElementById('routeNumberInput2').value = routeNumber;

            // モーダルを表示
            modal.classList.remove('hidden');

            // タブ表示の更新
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
            document.getElementById(activeTab).classList.add('active');
            document.querySelector(`[data-target="${activeTab}"]`).classList.add('active');
        }
    });
});
