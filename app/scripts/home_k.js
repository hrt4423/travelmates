// PHPからタイトルを取得する
fetch('dao/getData.php')
    .then(response => response.json())
    .then(data => {
        const titleList = document.getElementById('title-list');
        data.forEach(title => {
            const listItem = document.createElement('li');
            listItem.textContent = title;
            titleList.appendChild(listItem);
        });
    })
    .catch(error => console.error('Error:', error));
