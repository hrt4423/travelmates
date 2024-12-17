// モーダルとボタンの要素を取得
var modal = document.getElementById('modal');
var span = document.getElementById('closeModal');

var btn = document.getElementsByClassName('openModal');
//ボタンが複数ある場合があるので、配列に変換
const array = Array.prototype.slice.call(btn);

// ボタンをクリックしたときにモーダルを表示
//ボタンが複数ある場合があるので、forEachで回す
array.forEach((btn, index) => {
    console.log(index); // インデックスを表示
    btn.addEventListener('click', () => {
        modal.className = 'show';
        //ルート番号を割り当て
        document.getElementById('tab-transportation-route-number').value = index;
        document.getElementById('tab-itinerary-route-number').value = index;
    });
});

// × をクリックしたときにモーダルを閉じる
span.onclick = function () {
    modal.className = 'hidden';
}

// モーダルの外側をクリックしたときにモーダルを閉じる
window.onclick = function (event) {
    if (event.target == modal) {
        modal.className = 'hidden';
    }
}

// タブの切り替え
document.querySelectorAll('.tab').forEach(function (tab) {
    tab.addEventListener('click', function (event) {
        // すべてのタブとコンテンツを非アクティブにする
        document.querySelectorAll('.tab').forEach(function (t) {
            t.classList.remove('active');
        });
        document.querySelectorAll('.tab-content').forEach(function (content) {
            content.classList.remove('active');
        });

        // クリックされたタブと対応するコンテンツをアクティブにする
        var targetId = tab.getAttribute('data-target');
        tab.classList.add('active');
        document.getElementById(targetId).classList.add('active');
    });
});
