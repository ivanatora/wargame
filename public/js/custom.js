var map = L.map('map').fitWorld();

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
}).addTo(map);

var mPlayer = L.marker([0, 0]).addTo(map);

map.locate({setView: true, maxZoom: 16});


function fnMovePlayer(pos){
    var oNewPosition = L.latLng(pos.coords.latitude, pos.coords.longitude);
    var iDistance = map.getCenter().distanceTo(oNewPosition);
    
    if (iDistance > 300){
        map.panTo(oNewPosition);
    }
    mPlayer.setLatLng(oNewPosition);
}

function fnMovePlayerError(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
}

var oMovePlayerOptions = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

navigator.geolocation.watchPosition(fnMovePlayer, fnMovePlayerError, oMovePlayerOptions);