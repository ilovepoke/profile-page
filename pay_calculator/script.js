const coinsInput = document.getElementById("coins");
const peopleInput = document.getElementById("people");
const resultTotalElement = document.getElementById("resultTotalElement");
const coinsTotalInput = document.getElementById("coinsTotal");
const peopleTotalInput = document.getElementById("peopleTotal");
const resultTotalcoins = document.getElementById("resultTotalcoins");
const splitButton = document.getElementById("splitButton");
const totalButton = document.getElementById("totalButton");
const splitForm = document.getElementById("splitForm");
const totalForm = document.getElementById("totalForm");


function calculate(input1, input2, resultInput, operator) {
    const coinValue = Number(input1.value);
    const peopleValue = Number(input2.value);

    if (operator === "/" && peopleValue == 0) {
        alert("Number of people cannot be zero.");
        return;
    }

    let result;
    if(operator === "/"){
        result = coinValue / peopleValue;
        // resultTotalElement.textContent = result.toFixed(2);
    } else if (operator === "*" ) {
        result = coinValue * peopleValue;
        resultInput.textContent = result.toFixed(2);
    } else {
        alert("Invalid operation.");
        return;
    }

    resultInput.textContent = result.toFixed(2);
}

splitForm.addEventListener("submit", function(event){
    event.preventDefault();
    calculate(coinsInput, peopleInput, resultTotalElement, "/");
});

totalForm.addEventListener("submit", function(event){
    event.preventDefault();
    calculate(coinsTotalInput, peopleTotalInput, resultTotalcoins, "*");
});

const PayCaltoHomeButton = document.getElementById("PayCaltoHome-button");

PayCaltoHomeButton.addEventListener("click", function() {
    window.location.href = "/portfolio.html";
});

const PayCalculateButton = document.getElementById("PayCalculate-link");

PayCalculateButton.addEventListener("click", function() {
    window.location.href = "/pay_calculator";
});
