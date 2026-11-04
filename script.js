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

// 前回選択したテーマを読み込む
const savedTheme = localStorage.getItem("theme");

// ダークモード切り替えボタンを取得
const themeButton = document.getElementById("theme-toggle");

// ダークモード切り替えボタンが存在するページだけ処理する
if (themeButton) {

    // 前回ダークモードだった場合
    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
        themeButton.textContent = "☀️ Light Mode";
    }

    // ボタンが押されたとき
    themeButton.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            themeButton.textContent = "☀️ Light Mode";
            localStorage.setItem("theme", "dark");
        } else {
            themeButton.textContent = "🌙 Dark Mode";
            localStorage.setItem("theme", "light");
        }
    });
}


const menuToggle = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");

menuToggle.addEventListener("click", ()=>{
    // メニューの表示・非表示を切り替える
    sidebar.classList.toggle("active");

    // メニューが開いているか確認する
    const isOpen = sidebar.classList.contains("active");

    // ボタンの表示を切り替える
    menuToggle.textContent = isOpen ? "×" : "☰";

    // アクセシビリティ用の状態を更新する
    menuToggle.setAttribute("aria-expanded", isOpen);
    menuToggle.setAttribute(
        "aria-label",
        isOpen ? "メニューを閉じる" : "メニューを開く"
    );
});