const images = [
    {src: "assets/ab52494e-fab1-4b52-95ac-11739024f3a8.jpg", title: "タイトル1"},
    {src: "assets/faa0c56c-49a4-496c-b01f-d710c8b9986f.jpg", title: "タイトル2"},
    {src: "assets/ab52494e-fab1-4b52-95ac-11739024f3a8.jpg", title: "タイトル3"},
    {src: "assets/faa0c56c-49a4-496c-b01f-d710c8b9986f.jpg", title: "タイトル4"}
];

const container = document.getElementById('imageContainer');
images.forEach(image => {
    const imageWrapper = document.createElement('div');
    imageWrapper.className = 'col-12 col-md-6 image-wrapper';
    
    const img = document.createElement('img');
    img.src = image.src;
    img.alt = image.title;

    const title = document.createElement('div');
    title.className = 'title';
    title.textContent = image.title;

    // タイトルにクリックイベントを追加
    title.onclick = function() {
        window.location.href = 'travel_plan.html'; // 遷移先のページ
    };

    imageWrapper.appendChild(img);
    imageWrapper.appendChild(title);
    container.appendChild(imageWrapper);
});

// 新規作成ボタンを追加
const newCreateWrapper = document.createElement('div');
newCreateWrapper.className = 'col-12 col-md-6 new-create-wrapper';
newCreateWrapper.onclick = function() {
    window.location.href = 'new_create.html'; // 新規作成ページへのリンク
};

const newCreateTitle = document.createElement('div');
newCreateTitle.className = 'new-create-title';
newCreateTitle.textContent = '新規作成';

const newCreate = document.createElement('div');
newCreate.className = 'new-create';
newCreate.textContent = '+';

newCreateWrapper.appendChild(newCreateTitle);
newCreateWrapper.appendChild(newCreate);
container.appendChild(newCreateWrapper);
