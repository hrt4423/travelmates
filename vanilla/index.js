import './index.css';
import liff from '@line/liff'

element = document.getElementById("liff-message");
//liff-message の場所に "Hello, LIFF!" を表示
element.innerHTML = "Hello, LIFF!";


document.addEventListener("DOMContentLoaded", function() {
    // 特定の<p>タグを取得して内容を変更
    const paragraph = document.getElementById('liff-message');
    if (paragraph) {
        paragraph.textContent = 'Hello, LIFF!';
    } else {
        console.error("Element with id 'liff-message' not found.");
    }

  liff
    .init({ liffId: process.env.LIFF_ID })
    .then(() => {
        console.log("Success! you can do something with LIFF API here.");
        console.log(liff.getLanguage());
        console.log(liff.getOS());
        console.log(liff.getVersion());

        element = document.getElementById("liff-message");
        //liff-message の場所に "Hello, LIFF!" を表示
        element.innerHTML = "Hello, LIFF!";
    })
    .catch((error) => {
        console.log(error)
    })
});


