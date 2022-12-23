var oneWaySection = $("#oneWaySection");
var oneWayButton = $('#oneWayBtn');
var roundTripButton = $('#roundTripBtn');
var roundTripSection = $('#roundTripSection');
var flightType = document.getElementById('flightType');

roundTripButton.click(roundTrip);
oneWayButton.click(oneWay);

function roundTrip() {
    flightType.value = "Round trip";
    roundTripSection.show();
    oneWaySection.hide();
}

function oneWay() {
    flightType.value = "One way";
    roundTripSection.hide();
    oneWaySection.show();
}