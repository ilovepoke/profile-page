const themeButton = document.getElementById("theme-toggle");
// 保存されたテーマを読み込む
const savedTheme = localStorage.getItem("theme");
const showButton = document.getElementById("show-button");
const message = document.getElementById("profile-message");

const portfolioButton = document.getElementById("portfolio-button");

if(portfolioButton){
    portfolioButton.addEventListener("click", function() {
        window.location.href = "./portfolio.html";
    });
}

const PayCalculateButton = document.getElementById("PayCalculate-link");

if (PayCalculateButton) {
    PayCalculateButton.addEventListener("click", function () {
        window.location.href = "pay_calculator/index.html";
    });
}

if(showButton){
    showButton.addEventListener("click", function() {
        message.classList.toggle("hidden");
        if(message.classList.contains("hidden")){
            showButton.textContent = "詳しく見る";
        } else {
            showButton.textContent = "閉じる";
        };
    });
}

if(savedTheme === "dark"){
    document.body.classList.add("dark-mode");
    themeButton.textContent = "☀️ ライトモード";
}

if(themeButton){
    themeButton.addEventListener("click", function(){
    
        document.body.classList.toggle("dark-mode");
    
        if(document.body.classList.contains("dark-mode")){
            themeButton.textContent = "☀️ ライトモード";
            localStorage.setItem("theme", "dark");
        }else{
            themeButton.textContent = "🌙 ダークモード";
            localStorage.setItem("theme", "light");
        }
    
    });
}
