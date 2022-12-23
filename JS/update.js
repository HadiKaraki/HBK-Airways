const allInputs = document.getElementsByTagName('input');
const cancelButton = document.getElementById('cancelBtn');
const updtButton = document.getElementById('btnSubmit');
const chngInfoBtn = document.getElementById('changeInfoBtn');

function enable() {
    chngInfoBtn.style.display = 'none';
    cancelButton.style.display = 'block';
    updtButton.style.display = 'block';
    for (let input of allInputs) {
        input.disabled = false;
    }
}

function disable() {
    chngInfoBtn.style.display = 'block';
    cancelButton.style.display = 'none';
    updtButton.style.display = 'none';
    for (let input of allInputs) {
        input.disabled = true;
    }  
}    