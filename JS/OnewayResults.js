var showDetailsBtns = document.querySelectorAll('#showDetails');
var currentButton;
for (let button of showDetailsBtns) {
    button.addEventListener('click', getFlightInfo);
}

function getFlightInfo(e) {
    var id = e.target.parentNode.id;
    var ajaxSec = e.target.parentNode.querySelector("#ajaxSection");
    ajaxSec.style.display = "block";
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        const results = JSON.parse(this.responseText);
        ajaxSec.querySelector("#arrival_time").innerHTML = results.arrival_time;
        ajaxSec.querySelector("#aircraft").innerHTML = results.aircraft;
        ajaxSec.querySelector("#terminal").innerHTML = results.terminal;
        ajaxSec.querySelector("#duration").innerHTML = results.duration;
    }
    xmlhttp.open("GET", `ajax.php?id=${id}`);
    xmlhttp.send();
}

var removeDetailsBtn = document.querySelectorAll('#closeDetails');
for (let button of removeDetailsBtn) {
    button.addEventListener("click", clearContent);
}

function clearContent(e) {
    var ajaxSec = e.target.parentNode;
    ajaxSec.style.display = "none";
}