var map = L.map('map').fitWorld();

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
}).addTo(map);

var mPlayer = L.marker([0, 0]).addTo(map);

map.locate({setView: true, maxZoom: 16});


function success(pos){
    console.log('pos', pos)
//    L.marker([pos.coords.latitude, pos.coords.longitude]).addTo(map)
    mPlayer.setLatLng([pos.coords.latitude, pos.coords.longitude]);
}

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
}

var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

navigator.geolocation.watchPosition(success, error, options);