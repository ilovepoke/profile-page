const button = document.getElementById("show-button");
const message = document.getElementById("profile-message");

button.addEventListener("click", function() {
    message.classList.toggle("hidden");
    if(message.classList.contains("hidden")){
        button.textContent = "詳しく見る";
    } else {
        button.textContent = "閉じる";
    };
});

