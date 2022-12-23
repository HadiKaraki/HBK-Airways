var showDetailsBtns = document.querySelectorAll('#showDetails');
var currentButton;
for (let button of showDetailsBtns) {
    button.addEventListener('click', getFlightInfo);
}

function getFlightInfo(e) {
    var id = e.target.parentNode.parentNode.id;
    console.log(id);
    var parentForm = e.target.parentNode.parentNode;
    var infoDivs = parentForm.querySelectorAll("#info");
    for (let div of infoDivs) {
        div.style.display = "block";
    }
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        const results = JSON.parse(this.responseText);
        parentForm.querySelector("#arrival_time1").innerHTML = results.arrival_time1;
        parentForm.querySelector("#aircraft1").innerHTML = results.aircraft1;
        parentForm.querySelector("#terminal1").innerHTML = results.terminal1;
        parentForm.querySelector("#duration1").innerHTML = results.duration;
        parentForm.querySelector("#arrival_time2").innerHTML = results.arrival_time2;
        parentForm.querySelector("#aircraft2").innerHTML = results.aircraft2;
        parentForm.querySelector("#terminal2").innerHTML = results.terminal2;
        parentForm.querySelector("#duration2").innerHTML = results.duration;
    }
    xmlhttp.open("GET", `ajax.php?id=${id}`);
    xmlhttp.send();
}

var removeDetailsBtn = document.querySelectorAll('#closeDetails');
for (let button of removeDetailsBtn) {
    button.addEventListener("click", clearContent);
}

function clearContent(e) {
    var parentForm = e.target.parentNode.parentNode.parentNode;
    var infoDivs = parentForm.querySelectorAll("#info");
    for (let div of infoDivs) {
        div.style.display = "none";
    }
}