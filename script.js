// dark mode切り替えボタンを取得
const themeButton = document.getElementById("theme-toggle");

// 前回選択したテーマ（dark/light）をブラウザから読み込む
const savedTheme = localStorage.getItem("theme");

// ”詳しく見る”ボタンを取得
const showButton = document.getElementById("show-button");

// 表示・非表示を切り替える自己紹介メッセージを取得
const message = document.getElementById("profile-message");

// PAY CALCULATORページへ移動するボタンを取得
const PayCalculateButton = document.getElementById("PayCalculate-link");

// ボタンが存在するページだけイベントを登録
if(PayCalculateButton){
    PayCalculateButton.addEventListener("click", function() {
        window.location.href = "pay-calculator/index.html";
    });
}

// 「詳しく見る」ボタンが存在するページだけイベントを登録
if(showButton){
    showButton.addEventListener("click", function() {
        // hiddenクラスをつけ外しして表示・非表示を切り替える
        message.classList.toggle("hidden");
        
        // ボタンの文字を現在の状態に合わせて変更する
        if(message.classList.contains("hidden")){
            showButton.textContent = "詳しく見る";
        } else {
            showButton.textContent = "閉じる";
        };
    });
}

// 前回ダークモードだった場合はページをダークモードで表示
if(savedTheme === "dark"){
    document.body.classList.add("dark-mode");
    themeButton.textContent = "☀️ Light Mode";
}

// ダークモード切替ボタンが押された時の処理
themeButton.addEventListener("click", function(){
    // dark-modeクラスをつけ外ししてテーマを切り替える
    document.body.classList.toggle("dark-mode");

    if(document.body.classList.contains("dark-mode")){
        // dark-mode中はボタンの表示を「ライトモード」に変更
        themeButton.textContent = "☀️ Light Mode";
        // ダークモードをブラウザに保存
        localStorage.setItem("theme", "dark");
    }else{
        // ライトモード中はボタンの表示を「ダークモード」に変更
        themeButton.textContent = "🌙 Dark Mode";
        // ライトモードをブラウザに保存
        localStorage.setItem("theme", "light");
    }
});