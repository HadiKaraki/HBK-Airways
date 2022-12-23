const changeCurr = $('#changeCurrency');
const currency = $('#currency');
const price = $('#price');
const originalPrice = price.text();
const euroPrice = parseInt(originalPrice) * 0.98
const poundsPrice = parseInt(originalPrice) * 0.87

changeCurr.click(changeCurrency);

function changeCurrency() {
    if (changeCurr.val() == "Euro") {
        currency.html("&euro;");
        price.html(euroPrice);
    } else if (changeCurr.val() == "Dollar") {
        currency.html("$");
        price.html(originalPrice);
    } else if (changeCurr.val() == "Pounds") {
        currency.html("&#163;");
        price.html(poundsPrice);
    }
}