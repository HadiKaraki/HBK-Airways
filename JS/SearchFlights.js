const form = document.getElementById('form')
const fromInput = document.getElementById('selectTo');
const toInput = document.getElementById('selectFrom')
const plusBtn1 = $('#plus1');
const minusBtn1 = $('#minus1');
const plusBtn2 = $('#plus2');
const minusBtn2 = $('#minus2');
const plusBtn3 = $('#plus3');
const minusBtn3 = $('#minus3');
const inputField1 = document.getElementById('input1');
const inputField2 = document.getElementById('input2');
const inputField3 = document.getElementById('input3');
const searchBtn = $('#search');
const departDateInput = document.getElementById('depart_on_input')
const returnDateInput = document.getElementById('return_on_input')
plusBtn1.click(plus);
minusBtn1.click(minus);
plusBtn2.click(plus);
minusBtn2.click(minus);
plusBtn3.click(plus);
minusBtn3.click(minus);
searchBtn.click(validate);

function validate(e) {
    var textTo = fromInput.options[fromInput.selectedIndex].text;
    var textFrom = toInput.options[toInput.selectedIndex].text;
    console.log(textTo);
    if (textTo == textFrom) {
        alert("Your departure and destination are the same")
        e.preventDefault()
    }
    const departDate = new Date(departDateInput.value);
    const returnDate = new Date(returnDateInput.value);
    const daysDepartDate = departDate / (1000 * 3600 * 24)
    const daysReturnDate = returnDate / (1000 * 3600 * 24)
    if (daysDepartDate - daysReturnDate >= -2) {
        alert("At least two days must be between your departure date and return date")
        e.preventDefault()
    }
}

function plus(e) {
    if (e.target.id == "plus1") {
        const currentValue = Number(inputField1.value) || 0;
        inputField1.value = currentValue + 1;
    } else if (e.target.id == "plus2") {
        const currentValue = Number(inputField2.value) || 0;
        inputField2.value = currentValue + 1;
    } else if (e.target.id == "plus3") {
        const currentValue = Number(inputField3.value) || 0;
        inputField3.value = currentValue + 1;
    }
}

function minus(e) {
    if (e.target.id == "minus1") {
        if (inputField1.value > 1) {
            const currentValue = Number(inputField1.value);
            inputField1.value = currentValue - 1;
        }
    } else if (e.target.id == "minus2") {
        if (inputField2.value > 0) {
            const currentValue = Number(inputField2.value);
            inputField2.value = currentValue - 1;
        }
    } else if (e.target.id == "minus3") {
        if (inputField3.value > 0) {
            const currentValue = Number(inputField3.value);
            inputField3.value = currentValue - 1;
        }
    }
}

const returnOnDiv = $('#return_on')
const roundTripButton = $('#roundTripBtn')
const oneWayButton = $('#oneWayBtn');
roundTripButton.click(roundTrip);
oneWayButton.click(oneWay);

function roundTrip() {
    roundTripButton.css('background-color', 'rgb(240, 240, 240)');
    oneWayButton.css('background-color', 'white');
    returnOnDiv.show();
    returnDateInput.required = true;
    form.action = "roundTripResults.php"
}

function oneWay() {
    oneWayButton.css('background-color', 'rgb(240, 240, 240)');
    roundTripButton.css('background-color', 'white');
    returnOnDiv.hide();
    returnDateInput.required = false;
    form.action = "onewayResults.php"
}