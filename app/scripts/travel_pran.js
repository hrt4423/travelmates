// モーダルとボタンの要素を取得
var modal = document.getElementById('modal');
var btn = document.getElementById('openModal');
var span = document.getElementById('closeModal');

// ボタンをクリックしたときにモーダルを開く
btn.onclick = function() {
    modal.className = 'show';
}

// × をクリックしたときにモーダルを閉じる
span.onclick = function() {
    modal.className = 'hidden';
}

// モーダルの外側をクリックしたときにモーダルを閉じる
window.onclick = function(event) {
    if (event.target == modal) {
        modal.className = 'hidden';
    }
}

// タブの切り替え
document.querySelectorAll('.tab').forEach(function(tab) {
    tab.addEventListener('click', function(event) {
        // すべてのタブとコンテンツを非アクティブにする
        document.querySelectorAll('.tab').forEach(function(t) {
            t.classList.remove('active');
        });
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('active');
        });

        // クリックされたタブと対応するコンテンツをアクティブにする
        var targetId = tab.getAttribute('data-target');
        tab.classList.add('active');
        document.getElementById(targetId).classList.add('active');
    });
});
